<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\Product;
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

        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantite'=>'required|integer|min:1',
            'type'=>'required|string',
            'fournisseur'=>'required|string',
            'prix_unitaire'=>'required|numeric|min:0',
            'taxe'=>'required|numeric|min:0',
            'prix_achat'=>'required|numeric|min:0',
            'date_achat'=>'required|date'
        ]);
        $product= Product::findOrFail($request->product_id);
        $quantite=$request->quantite;
        $prixUnitaire= $request->prix_unitaire;
        $total=$quantite*$prixUnitaire;
        //mise a jour des stocks
        $product->quantite+=$quantite;
        $product->save();
        //sauvgarde des l'achat
        $achat =Achat::create([
            'product_id'=>$product->id,
            'type'=>$product->type,
            'quantite'=>$quantite,
            'prix_unitaire'=>$prixUnitaire,
            'taxe'=>$request->taxe,
            'fournisseur'=>$request->fournisseur,
            'prix_achat'=>$request->prix_achat,
            'date_achat'=>$request->date_achat ?? now(),
        ]);
        return redirect()->route('achats')->with('success','achat ajouter');


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
