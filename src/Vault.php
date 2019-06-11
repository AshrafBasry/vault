<?php

namespace Basry\Vault;

use Basry\Vault\Contracts\Vault as VaultActions;
use Basry\Vault\Exceptions\InsufficientBalanceException;
use Carbon\Carbon;

class Vault implements VaultActions
{
    const WITHDRAW = 'withdraw';
    const DEPOSIT = 'deposit';
    /**
     * VaultLedger Model Instance
     *
     * @var \VaultLedger
     */
    private $ledger;

    /**
     * [$type description]
     *
     * @var [type]
     */
    private $type;

    /**
     * [$amount description]
     *
     * @var [type]
     */
    private $amount;

    /**
     * [$date description]
     *
     * @var [type]
     */
    private $date;

    /**
     * [$reason description]
     *
     * @var [type]
     */
    private $reason;

    /**
     * [__construct description]
     *
     * @param VaultLedger $ledger [description]
     */
    public function __construct(VaultLedger $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * Get Vault Current Balance
     *
     * @return float
     */
    public function getBalance()
    {
        return number_format($this->ledger->balance(), config('vault.decimal'), '.', '');
    }

    /**
     * [getLedgers description]
     *
     * @return [type] [description]
     */
    public function getLedgers()
    {
        return $this->ledger->orderBy('date', 'desc')->get();
    }
    /**
     * Make A Deposit Operation
     *
     * @param  float $amount
     * @param  date $date
     * @param  string $reason
     * @return bool
     */
    public function deposit(float $amount, $date, string $reason)
    {
        $this->prepare(self::DEPOSIT, $amount, $date, $reason);
        return $this->createRecord();
    }

    /**
     * Make A Withdraw Operation
     *
     * @param  float|integer $amount
     * @param  date $date
     * @param  string $reason
     * @return bool
     */
    public function withdraw(float $amount, $date, string $reason)
    {
        $this->prepare(self::WITHDRAW, $amount, $date, $reason);
        if ($this->checkBalanceBeforeWithdraw()) {
            return $this->createRecord();
        }
        throw new InsufficientBalanceException('Insufficient Balance');
    }

    /**
     * Delete A Vault Operation
     *
     * @param  integer $id
     * @return bool
     */
    public function delete($id)
    {
    }

    /**
     * [prepare description]
     *
     * @param  [type] $type   [description]
     * @param  [type] $amount [description]
     * @param  [type] $date   [description]
     * @param  [type] $reason [description]
     * @return void
     */
    private function prepare($type, $amount, $date, $reason)
    {
        $this->date = (new Carbon($date))->format('Y-m-d');
        $this->type = $type;
        $this->amount = abs($amount);
        $this->reason = $reason;
    }

    /**
     * [createRecord description]
     *
     * @return [type] [description]
     */
    private function createRecord()
    {
        $data = [
            'type'    => $this->type,
            'amount'  => $this->amount,
            'date'    => $this->date,
            'reason'  => $this->reason,
        ];
        return $this->ledger->create($data);
    }

    /**
     * [checkBalanceBeforeWithdraw description]
     *
     * @return bool
     */
    private function checkBalanceBeforeWithdraw()
    {
        return $this->amount <= $this->ledger->balance();
    }
}
