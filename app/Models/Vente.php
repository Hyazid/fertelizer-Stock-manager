<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    //
    protected $fillable= [
        'product_id',
        'quantite',
        'prix_unitaire',
        'taxe',
        'client',
        'date_vente',

    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
