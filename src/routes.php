<?php

Route::get('/Vault', 'Basry\Vault\Http\Controllers\VaultController@index');
Route::get('/Vault/deposit/{amount}', 'Basry\Vault\Http\Controllers\VaultController@deposit');
Route::get('/Vault/withdraw/{amount}', 'Basry\Vault\Http\Controllers\VaultController@withdraw');