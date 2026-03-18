<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Hyaluron Serum', 
            'price' => 49.90, 
            'description' => 'Hochkonzentriertes Serum für intensive Feuchtigkeit.',
            'category' => 'Gesichtspflege',
            'stock' => 10
        ]);
        Product::create([
            'name' => 'Reinigungsmilch Sanft', 
            'price' => 24.50, 
            'description' => 'Besonders mild für empfindliche Haut.',
            'category' => 'Gesichtspflege',
            'stock' => 15
        ]);
        Product::create([
            'name' => 'Tagespflege LSF 30', 
            'price' => 38.00, 
            'description' => 'Schützt vor UV-Strahlen und pflegt den ganzen Tag.',
            'category' => 'Gesichtspflege',
            'stock' => 20
        ]);
    }
}