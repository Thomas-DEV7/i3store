<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {
        Product::factory()->count(10)->create(); // Cria 10 produtos aleatórios
    }
}
