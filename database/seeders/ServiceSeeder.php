<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create(['name' => 'Gesichtsbehandlung Classic', 'price' => 59.00]);
        Service::create(['name' => 'Microneedling', 'price' => 120.00]);
        Service::create(['name' => 'Microdermabrasion', 'price' => 85.00]);
        Service::create(['name' => 'Wimpernlifting', 'price' => 45.00]);
        Service::create(['name' => 'Augenbrauen zupfen & färben', 'price' => 25.00]);
        Service::create(['name' => 'Maniküre mit Shellac', 'price' => 40.00]);
        Service::create(['name' => 'Pediküre Classic', 'price' => 35.00]);
    }
}