<?php

namespace Basry\Vault;

use Illuminate\Database\Eloquent\Model;

class VaultLedger extends Model
{
	/**
	 * [$fillable description]
	 * @var [type]
	 */
	protected $fillable = [
		'order', 'amount', 'balance', 'date', 'reason'
	];
}
