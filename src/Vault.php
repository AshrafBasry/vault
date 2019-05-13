<?php

namespace Basry\Vault;

use Basry\Vault\Contracts\Vault as VaultActions;

class Vault implements VaultActions
{
	/**
	 * VaultLedger Model Instance
	 * @var \VaultLedger
	 */
	protected $ledger;

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
		return number_format((float) $this->ledger->orderBy('order', 'desc')->pluck('balance')->first(), 2, '.', '');
	}

	/**
	 * Make A Deposit Operation .
	 * @param  float $amount  
	 * @param  date $date   
	 * @param  string $note 
	 * @return bool
	 */
	public function deposit($amount, $date, $note)
	{

	}

	/**
	 * Make A Withdraw Operation .
	 * @param  float|integer $amount  
	 * @param  date $date   
	 * @param  string $note
	 * @return bool
	 */
	public function withdraw($amount, $date, $note)
	{

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
}