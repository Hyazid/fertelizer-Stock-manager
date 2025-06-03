<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('name', 'type', 'description', 'quantite', 'prix_unitaire')->get();
    }
    public function headings(): array
    {
        return ['Nom', 'Type', 'Description', 'Quantité', 'Prix Unitaire'];
    }
}
