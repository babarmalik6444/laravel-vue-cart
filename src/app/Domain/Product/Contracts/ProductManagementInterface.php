<?php

namespace App\Domain\Product\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductManagementInterface
{
    public function getAllProducts(): LengthAwarePaginator;
}
