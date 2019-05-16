<?php

namespace Basry\Vault;

use Illuminate\Support\ServiceProvider;

class VaultServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Contracts\Vault::class, Vault::class);
        //
        $this->mergeConfigFrom(__DIR__.'/../config/vault.php', 'vault');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //
        $this->publishes([
            __DIR__.'/../config/vault.php' => config_path('vault.php'),
        ], 'vault-config');
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'vault-migrations');
    }
}
