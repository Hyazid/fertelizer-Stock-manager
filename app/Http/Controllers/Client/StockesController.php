<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockesController extends Controller
{
    //
    public function index(){
        return view('clients.ccls.stockes');
    }
}
