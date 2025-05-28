<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'type', 'description', 'quantite', 'prix_unitaire',
    ];
    
}
