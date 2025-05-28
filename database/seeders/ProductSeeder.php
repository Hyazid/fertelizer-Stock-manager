<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            // Sacherie
            ['name' => 'Sac 50kg', 'type' => 'sacherie', 'description' => 'Sac de 50kg pour céréales', 'quantite' => 150, 'prix_unitaire' => 1200],
            ['name' => 'Sac 25kg', 'type' => 'sacherie', 'description' => 'Sac de 25kg résistant', 'quantite' => 200, 'prix_unitaire' => 800],

            // Produit fongique
            ['name' => 'Fongicide X', 'type' => 'produit fongique', 'description' => 'Fongicide contre moisissure', 'quantite' => 75, 'prix_unitaire' => 3500],
            ['name' => 'Fongiclean', 'type' => 'produit fongique', 'description' => 'Produit curatif pour plantes', 'quantite' => 50, 'prix_unitaire' => 4100],

            // Pièce de rechange
            ['name' => 'Pompe irrigation', 'type' => 'pièce de rechange', 'description' => 'Pompe à haute pression', 'quantite' => 20, 'prix_unitaire' => 8700],
            ['name' => 'Tuyau flexible', 'type' => 'pièce de rechange', 'description' => 'Tuyau 10m', 'quantite' => 100, 'prix_unitaire' => 1300],

            // Insecticide
            ['name' => 'Insectikill', 'type' => 'insecticide', 'description' => 'Tue tous types d’insectes', 'quantite' => 90, 'prix_unitaire' => 2900],
            ['name' => 'BioInsect', 'type' => 'insecticide', 'description' => 'Insecticide écologique', 'quantite' => 60, 'prix_unitaire' => 3600],

            // Engrais
            ['name' => 'Engrais NPK 20-10-10', 'type' => 'engrais', 'description' => 'Engrais équilibré', 'quantite' => 180, 'prix_unitaire' => 1700],
            ['name' => 'Compost organique', 'type' => 'engrais', 'description' => 'Compost 100% naturel', 'quantite' => 250, 'prix_unitaire' => 950],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
