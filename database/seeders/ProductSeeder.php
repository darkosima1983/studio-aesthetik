<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
   public function run(): void
{
    $products = [
        [
            'name' => 'Diamond Glow Serum',
            'price' => 59.90,
            'description' => 'Hochkonzentriertes Vitamin C Serum für strahlende Haut.',
            'stock' => 15
        ],
        [
            'name' => 'Nachtcreme Arganöl',
            'price' => 34.50,
            'description' => 'Reichhaltige Pflege für die Regeneration über Nacht.',
            'stock' => 10
        ],
        [
            'name' => 'Reinigungsmilch Sanft',
            'price' => 19.00,
            'description' => 'Milde Reinigung für empfindliche Gesichtshaut.',
            'stock' => 20
        ],
    ];

    foreach ($products as $product) {
        \App\Models\Product::create($product);
    }
}
}
