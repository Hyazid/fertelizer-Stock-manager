<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StockController extends Controller
{
    public function index(){
        $products= Product::all();
        return view('admin.stock', compact('products'));
    
    }
    public function create(){

    }
    public function store(Request $request){
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite'    => 'required|integer|min:0',
            'prix_unitaire'  => 'required|numeric|min:0',
        ]);
        Product::create($request->all());
        return redirect()->route('dashboard')->with('success','Produit ajouter avec succes');
    }

}
