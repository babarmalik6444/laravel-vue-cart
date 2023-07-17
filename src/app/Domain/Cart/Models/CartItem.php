<?php

namespace App\Domain\Cart\Models;

use App\Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
