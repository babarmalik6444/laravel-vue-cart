<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Contracts\ProductManagementInterface;
use App\Domain\Product\Models\Product;

class ProductService implements ProductManagementInterface
{
    public function getAllProducts()
    {
        return Product::active()->paginate(10);
    }
}
