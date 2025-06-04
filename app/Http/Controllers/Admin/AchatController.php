<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $achats=Achat::with('product')->get();
        return view('admin.achats',compact('achats','products'));
    }
    public function store(Request $request){

        
            $validated=$request->validate([
                'product_id' => 'required|exists:products,id',
                'quantite' => 'required|integer|min:1',
                'type' => 'required|string',
                'fournisseur' => 'required|string',
                'prix_unitaire' => 'required|numeric|min:0',
                'taxe' => 'required|numeric|min:0',
                'prix_achat' => 'required|numeric|min:0',
                'date_achat' => 'required|date'
            ]);
    
            $product = Product::findOrFail($request->product_id);
            $quantite = $request->quantite;
            $prixUnitaire = $request->prix_unitaire;
    
            // mise à jour des stocks
            $product->quantite += $quantite;
            $product->save();
            //dd($product);
            $achats=Achat::create([

                'product_id'=>$validated['product_id'],
                'produit'=>$product->nom,
                'type'=>$validated['type'],
                'quantite'=>$validated['quantite'],
                'prix_achat'=>$validated['prix_achat'],
                'prix_unitaire'=>$validated['prix_unitaire'],
                'taxe'=>$validated['taxe'],
                'fournisseur'=>$validated['fournisseur'],
                'date_achat'=>$validated['date_achat'],
            ]);
            
            
            return redirect()->route('achats')->with('success', 'Achat ajouté avec succès !');

    
        
    }
    public function creare(){
        $products = Product::all();
        return view('achats.create', compact('products'));

    }
    public function update(){

    }
    public function destroy(){

    }
}
