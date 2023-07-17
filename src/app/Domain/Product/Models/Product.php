<?php

namespace App\Domain\Product\Models;

use App\Domain\Product\Enums\ProductStaus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'quantity', 'status'];

    public function scopeActive()
    {
        return $this->where('status', ProductStaus::STATUS_ACTIVE);
    }
}
