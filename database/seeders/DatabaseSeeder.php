<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ovaj fajl samo poziva gornja dva
        $this->call([
            ServiceSeeder::class,
            ProductSeeder::class,
        ]);
    }
}