<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardControllerCCLS extends Controller
{
    //
    public function index(){
        return view('clients.ccls.dashboard');
    }
}
