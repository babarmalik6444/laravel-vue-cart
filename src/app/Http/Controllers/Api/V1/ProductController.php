<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\Product\Contracts\ProductManagementInterface;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductManagementInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }
}
