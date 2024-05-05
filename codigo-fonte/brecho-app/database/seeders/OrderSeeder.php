<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 5; $i++) {
            Order::create([
                'user_id' => rand(1, 2), // Assuming you have users in the database
                'status' => 'pending', // or any other status you want to set
                'date' => now(),
                'address' => 'Address ' . ($i + 1),
                'number' => rand(1, 100),
                'complement' => 'Complement ' . ($i + 1),
                'district' => 'District ' . ($i + 1),
                // 'cep' => 'CEP ' . ($i + 1),
                'city' => 'City ' . ($i + 1),
                'state' => 'State ' . ($i + 1),
                'total' => rand(50, 200), // Assuming total is a random amount
                // 'track_code' => 'ABC' . rand(1000, 9999) // Assuming track code is random
            ]);
        }
    }
}
