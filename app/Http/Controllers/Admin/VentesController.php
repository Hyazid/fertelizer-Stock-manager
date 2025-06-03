<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vente;
use Illuminate\Http\Request;

class VentesController extends Controller
{
    //
    public function index(){
        $ventes= Vente::with('product')->latest()->get();
        $products= Product::all();
        return view('admin.ventes',compact('ventes', 'products'));
    }
    public function create(){

    }
    public function store(Request $request){
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantite'=>'required|integer|min:1',
            'type' => 'required|string',
            'taxe' => 'required|numeric|min:0',
        ]);
        $product= Product::findOrFail($request->product_id);
        $quantite = $request->quantite;
        $type=$request->type;
        $taxe= $request->taxe;
        $prixUnitaire= $product->prix_unitaire;
        $total= ($quantite*$prixUnitaire)+$taxe;


        if ($product->quantite< $quantite)
         {
            # code...
            return response()->json(['error'=>'quantite insuffisante']);

        }
        $product->quantite-=$quantite;
        $product->save();
        $vente=Vente::create([
            'product_id' => $product->id,
            'quantite' => $quantite,
            'prix_unitaire' => $prixUnitaire,
            'type'=>$type,
            'total' => $total,
            'client' => $request->client,
            'date_vente' => $request->date_vente ?? now()
        ]);
         return response()->json(['success'=>true,'vente'=>$vente]);



    }
    public function update(){

    }
    public function destroy(){

    }
}
