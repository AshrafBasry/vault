<?php

namespace Basry\Vault\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Basry\Vault\Contracts\Vault;

class VaultController extends Controller
{
    public function index(Vault $vault)
    {
    	$balance = $vault->getBalance();
    	return $balance;
    }
}
