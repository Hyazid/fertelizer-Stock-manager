<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class livraison extends Model
{
    //
    protected $fillable=[
        'numero_livraison',
        'date_livraison',
        'date_prevue',
        'adresse_livraison',
        'ville',
        'code_postal',
        'statut',
        'client_nom',
        'client_telephone',
        'client_email',
        'livreur_nom',
        'livreur_telephone',
        'commentaire',
        'prix_total',
        'frais_livraison',
    ];
    //statue possible
    const STATUTS =[
        'en_attente'=>'En_attente',
        'preparee'=>'Preparee',
        'en_cours'=>'En cours de livraison',
        'livree'=>'livree',
        'annuler'=>'annuler',
        'reporter'=>'reporter'
    ];
    //relation many to many with product
    public function Products():BelongsToMany{
        return $this->belongsToMany(Product::class,'product_id');
    }
}
