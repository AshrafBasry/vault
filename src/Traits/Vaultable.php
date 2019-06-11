<?php

namespace Basry\Vault\Traits;

use Basry\Vault\VaultLedger;
use Basry\Vault\Facades\Vault;
use Basry\Vault\Exceptions\InsufficientBalanceException;

trait Vaultable
{
    /**
     * [vault description]
     * 
     * @return [type] [description]
     */
    public function vault()
    {
        return $this->belongsTo(VaultLedger::class);
    }

    /**
     * [createWithDeposit description]
     * 
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public static function createWithDeposit(array $attributes = [])
    {
        $record = Vault::deposit($attributes['amount'], $attributes['date'], $attributes['reason']);
        $attributes['vault_ledger_id'] = $record->id;
        return static::query()->create($attributes);
    }

    /**
     * [createWithWithdraw description]
     * 
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public static function createWithWithdraw(array $attributes = [])
    {
        try {
            $record = Vault::withdraw($attributes['amount'], $attributes['date'], $attributes['reason']);
        } catch (InsufficientBalanceException $e) {
            return false;
        }
        $attributes['vault_ledger_id'] = $record->id;
        return static::query()->create($attributes);
    }

    /**
     * [create description]
     * 
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public static function create(array $attributes = [])
    {
        $defaultAction = static::getDefaultAction();
        if ($defaultAction === 'deposit') {
            return static::createWithDeposit($attributes);
        } elseif ($defaultAction === 'withdraw') {
            return static::createWithWithdraw($attributes);
        }
        return static::query()->create($attributes);
    }

    /**
     * [getDefaultAction description]
     * 
     * @return [type] [description]
     */
    protected static function getDefaultAction()
    {
        return isset(static::$vaultDefaultAction) ? static::$vaultDefaultAction : null;
    }
}
