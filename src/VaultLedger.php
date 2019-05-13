<?php

namespace Basry\Vault;

use Illuminate\Database\Eloquent\Model;

class VaultLedger extends Model
{
    //
		public function vaultable()
		{
			return $this->morphTo();
		}
}
