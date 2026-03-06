<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Gesichtsreinigung Klassik', 'price' => 45.00, 'duration' => 60, 'description' => 'Tiefenreinigung, Peeling und Maske.'],
            ['name' => 'Anti-Aging Diamond', 'price' => 85.00, 'duration' => 90, 'description' => 'Exklusive Behandlung mit Hyaluron.'],
            ['name' => 'Maniküre Basic', 'price' => 25.00, 'duration' => 30, 'description' => 'Nagelpflege und Formgebung.'],
            ['name' => 'Maniküre mit Shellac', 'price' => 45.00, 'duration' => 60, 'description' => 'Langanhaltender Glanz für Ihre Nägel.'],
            ['name' => 'Pediküre Klassik', 'price' => 35.00, 'duration' => 45, 'description' => 'Professionelle Fußpflege.'],
            ['name' => 'Rückenmassage', 'price' => 40.00, 'duration' => 30, 'description' => 'Entspannung für Nacken und Rücken.'],
            ['name' => 'Ganzkörpermassage', 'price' => 75.00, 'duration' => 60, 'description' => 'Vollständige Entspannung von Kopf bis Fuß.'],
            ['name' => 'Augenbrauen zupfen', 'price' => 12.00, 'duration' => 15, 'description' => 'Perfekte Form für Ihre Brauen.'],
            ['name' => 'Wimpernlifting', 'price' => 55.00, 'duration' => 45, 'description' => 'Natürlicher Schwung für Ihre Wimpern.'],
            ['name' => 'Tages-Make-up', 'price' => 30.00, 'duration' => 30, 'description' => 'Dezent i elegant za svaki dan.'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
