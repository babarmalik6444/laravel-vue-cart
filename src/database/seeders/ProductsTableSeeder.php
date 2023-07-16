<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Product\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Generate 25 products
        if (Product::count() === 0) {
            for ($i = 1; $i <= 25; $i++) {
                Product::create([
                    'name' => 'Product ' . $i,
                    'description' => 'This is the description for Product ' . $i,
                    'price' => rand(10, 100),
                    'quantity' => rand(1, 50),
                    'status' => true,
                ]);
            }
        }
    }
}

