<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Product\Contracts\ProductManagementInterface;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(
        private ProductManagementInterface $productService
    ) {
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }
}
