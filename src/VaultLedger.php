<?php

namespace Basry\Vault;

use Illuminate\Database\Eloquent\Model;

class VaultLedger extends Model
{
    /**
     * [$fillable description]
     * 
     * @var [type]
     */
    protected $fillable = [
        'type', 'amount', 'date', 'reason',
    ];

    /**
     * [$casts description]
     * 
     * @var array
     */
    protected $casts = [
        'date' => 'date|Y-m-d',
    ];

    /**
     * [balance description]
     * 
     * @return [type] [description]
     */
    public function balance()
    {
        $deposits  = static::where('type', '=', 'deposit')->sum('amount');
        $withdraws = static::where('type', '=', 'withdraw')->sum('amount');
        return (float)($deposits - $withdraws);
    }
}
