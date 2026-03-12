<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
    {
        \App\Models\Pharmacy::insert([
            [
                'name' => 'Pharmacie Al Andalous',
                'city' => 'Marrakech',
                'address' => 'Avenue Mohammed V, Gueliz',
                'phone' => '0524-43-21-09',
                'is_24h' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pharmacie Centrale',
                'city' => 'Casablanca',
                'address' => 'Boulevard Zerktouni',
                'phone' => '0522-26-78-90',
                'is_24h' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more...
        ]);
    }
}
