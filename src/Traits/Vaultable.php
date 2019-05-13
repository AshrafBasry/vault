<?php

namespace Basry\Vault\Traits;

use Basry\Vault\VaultLedger;

trait Vaultable
{
	/**
	 * [vault description]
	 * @return [type] [description]
	 */
	public function vault()
	{
		return $this->morphMany(VaultLedger::class, 'vaultable');
	}
}