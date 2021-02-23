<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\TiendaController;

class CoinpaymentController extends Controller
{
    function __construct()

	{
        // TITLE
		view()->share('title', 'Tienda Interna Coinpayment');
	}
    /**
     * Lleva a la vista de la compra de productos por coinpayment
     *
     * @return void
     */
    public function index()
    {
        
    }


}
