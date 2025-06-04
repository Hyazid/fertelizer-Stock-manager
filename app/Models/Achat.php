<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable=[
        'product_id',
        'produit',
        'type',
        'quantite',
        'prix_unitaire',
        'taxe',
        'fournisseur',
        'prix_achat',
        'date_achat',

    ];
    public function produit(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function product(){
    return $this->belongsTo(Product::class, 'product_id');
    }
    public function achats(){
        return $this->hasMany(Achat::class,'product_id');
    }

}
