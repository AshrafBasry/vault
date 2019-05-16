<?php

namespace Basry\Vault\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Basry\Vault\Contracts\Vault;

class VaultController extends Controller
{

	public function __construct(Vault $vault)
	{
		$this->vault = $vault;
	}
	/**
	 * [index description]
	 * @return [type]        [description]
	 */
	public function index()
	{
		$balance = $this->vault->getBalance();
		$ledgers = $this->vault->getLedgers();
		return compact('balance', 'ledgers');
	}

	public function deposit($amount)
	{
		$this->vault->deposit($amount, '02/08/2019', 'Make Deposit');
		return redirect('/Vault');
	}

	public function withdraw($amount)
	{
		$this->vault->withdraw($amount, '12/08/2019', 'Make withdraw');
		return redirect('/Vault');
	}
}
