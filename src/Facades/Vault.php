<?php

namespace Basry\Vault\Facades;

use Illuminate\Support\Facades\Facade;
use Basry\Vault\Contracts\Vault as VaultContract;

class Vault extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return VaultContract::class;
    }
}
