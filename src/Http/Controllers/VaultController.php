<?php

namespace Basry\Vault\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Basry\Vault\Facades\Vault;
use Basry\Vault\Exceptions\InsufficientBalanceException as Exception;

class VaultController extends Controller
{
	/**
	 * [index description]
	 * @return [type]        [description]
	 */
	public function index()
	{
		$balance = Vault::getBalance();
		$ledgers = Vault::getLedgers();
		return compact('balance', 'ledgers');
	}

	public function deposit($amount)
	{
		Vault::deposit($amount, '02/08/2019', 'Make Deposit');
		return redirect('/Vault');
	}

	public function withdraw($amount)
	{
		try {
			Vault::withdraw($amount, '12/08/2019', 'Make withdraw');
		} catch (Exception $e) {
			return '<h2 style="color:red;text-align:center;">'. $e->getMessage() .'<h2>';
		}
		return redirect('/Vault');
	}
}
