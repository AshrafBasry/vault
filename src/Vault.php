<?php

namespace Basry\Vault;

use Basry\Vault\Contracts\Vault as VaultActions;
use Basry\Vault\Exceptions\InsufficientBalanceException;
use Carbon\Carbon;

class Vault implements VaultActions
{
    /**
     * VaultLedger Model Instance
     * @var \VaultLedger
     */
    private $ledger;

    private $order;
    private $amount;
    private $balance;
    private $date;
    private $reason;
    /**
     * [__construct description]
     * @param VaultLedger $ledger [description]
     */
    public function __construct(VaultLedger $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * Get Vault Current Balance
     * @return float
     */
    public function getBalance()
    {
        return number_format((float) $this->ledger->orderBy('order', 'desc')->pluck('balance')->first(), config('vault.decimal'), '.', '');
    }

    public function getLedgers()
    {
        return $this->ledger->orderBy('order', 'desc')->get();
    }
    /**
     * Make A Deposit Operation .
     * @param  float $amount
     * @param  date $date
     * @param  string $reason
     * @return bool
     */
    public function deposit(float $amount, $date, string $reason)
    {
        $this->prepare(abs($amount), $date, $reason);
        $this->updateNextRecords();
        return $this->createRecord();
    }

    /**
     * Make A Withdraw Operation .
     * @param  float|integer $amount
     * @param  date $date
     * @param  string $reason
     * @return bool
     */
    public function withdraw(float $amount, $date, string $reason)
    {
        $this->prepare(-abs($amount), $date, $reason);
        if ($this->checkBalanceBeforeWithdraw()) {
	        $this->updateNextRecords();
	        return $this->createRecord();
        }
        throw new InsufficientBalanceException();
    }

    /**
     * Update A Vault Operation
     * @param  integer $id
     * @param  float $newAmount
     * @param  date $newDate
     * @return bool
     */
    public function update($id)
    {
    }

    /**
     * Delete A Vault Operation
     * @param  integer $id
     * @return bool
     */
    public function delete($id)
    {
    }

    private function prepare($amount, $date, $reason)
    {
        $this->date = (new Carbon($date))->format('Y-m-d');
        $this->amount = $amount;
        $this->reason = $reason;
        $previousRecord = $this->getPreviousRecord();
        $this->order = $previousRecord ? $previousRecord->order + 1 : 1;
        $this->balance = $previousRecord ? $previousRecord->balance + $amount : $amount;
    }

    /**
     * Get The Previous Table Record
     * @return \VaultLedger Model Object
     */
    private function getPreviousRecord()
    {
        return $this->ledger->where('date', '<=', $this->date)->orderBy('order', 'desc')->first();
    }

    private function createRecord()
    {
        $data = [
            'order'   => $this->order,
            'amount'  => $this->amount,
            'balance' => $this->balance,
            'date'	  => $this->date,
            'reason'  => $this->reason,
        ];
        return $this->ledger->create($data);
    }

    private function updateNextRecords()
    {
        $records = $this->ledger->where('order', '>=', $this->order);
        $records->increment('order');
        $records->increment('balance', $this->amount);
    }

    private function checkBalanceBeforeWithdraw()
    {
    	return $this->order > 1 && $this->ledger
			 		->where('order', '>=', $this->order - 1)
    		 		->where('balance', '<', abs($this->amount))
    		 		->count() === 0;

    }
}
