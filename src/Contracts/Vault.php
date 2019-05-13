<?php

namespace Basry\Vault\Contracts;

interface Vault
{
	/**
	 * Get Vault Current Balance
	 * @return float 
	 */
	public function getBalance();

	/**
	 * Make A Deposit Operation .
	 * @param  float $amount  
	 * @param  date $date   
	 * @param  string $note 
	 * @return bool
	 */
	public function deposit($amount, $date, $note);

	/**
	 * Make A Withdraw Operation .
	 * @param  float|integer $amount  
	 * @param  date $date   
	 * @param  string $note
	 * @return bool
	 */
	public function withdraw($amount, $date, $note);

	/**
	 * Update A Vault Operation
	 * @param  integer $id
	 * @param  float $newAmount
	 * @param  date $newDate
	 * @return bool
	 */
	public function update($id, $newAmount, $newDate);

	/**
	 * Delete A Vault Operation
	 * @param  integer $id
	 * @return bool
	 */
	public function delete($id);
}