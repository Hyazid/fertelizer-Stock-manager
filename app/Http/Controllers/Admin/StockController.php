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
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'quantite'       => 'required|integer|min:0',
            'prix_unitaire'  => 'required|numeric|min:0',
        ]);
    
        try {
            Product::create($request->all());
            return redirect()->route('dashboard')->with('success', 'Produit ajouté avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'quantite'    => 'required|integer|min:0',
            'prix_unitaire'  => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
    
        $product = Product::findOrFail($id);
        $product->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'quantite'    => $request->quantite,
            'prix_unitaire'  => $request->prix_unitaire,
            'description' => $request->description,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Produit mis à jour avec succès.');

    }    

}
