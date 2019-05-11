<?php

namespace Basry\Vault\Traits;

use Basry\Vault\VaultLedger;

trait Vaultable
{

	public function vault()
	{
		return $this->belongsTo(VaultLedger::class);
	}
}