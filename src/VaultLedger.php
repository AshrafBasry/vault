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
        'order', 'amount', 'balance', 'date', 'reason',
    ];

    /**
     * [$casts description]
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'balance' => 'decimal:2',
        'date' => 'date|Y-m-d',
    ];
}
