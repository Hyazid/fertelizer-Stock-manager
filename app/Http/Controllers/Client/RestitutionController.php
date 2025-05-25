<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestitutionController extends Controller
{
    //
    public function index(){
        return view('clients.ccls.restitutions');
    }
}
