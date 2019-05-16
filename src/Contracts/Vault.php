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
	public function deposit(float $amount, $date, string $note);

	/**
	 * Make A Withdraw Operation .
	 * @param  float|integer $amount  
	 * @param  date $date   
	 * @param  string $note
	 * @return bool
	 */
	public function withdraw(float $amount, $date, string $note);

	/**
	 * Update A Vault Operation
	 * @param  integer $id
	 * @param  float $newAmount
	 * @param  date $newDate
	 * @return bool
	 */
	public function update($id);

	/**
	 * Delete A Vault Operation
	 * @param  integer $id
	 * @return bool
	 */
	public function delete($id);
}