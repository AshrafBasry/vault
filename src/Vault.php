<?php

namespace Basry\Vault;

use Contracts\Vault as VaultActions;

class Vault implements VaultActions
{
	/**
	 * [$ledger description]
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

	public function getBalance()
	{
		return (float) $this->ledger->orderBy('order', 'desc')->pluck('balance')->first();
	}
}