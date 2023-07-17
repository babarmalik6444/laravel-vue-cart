<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Contracts\ProductManagementInterface;
use App\Domain\Product\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService implements ProductManagementInterface
{
    public function getAllProducts(): LengthAwarePaginator
    {
        return Product::active()->paginate(10);
    }
}
