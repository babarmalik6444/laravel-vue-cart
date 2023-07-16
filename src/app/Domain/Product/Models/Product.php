<?php

namespace App\Domain\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    private const STATUS_ACTIVE = 1;
    private const STATUS_DISABLED = 0;

    protected $fillable = ['name', 'description', 'price', 'quantity', 'status'];


    public function scopeActive() {
        return $this->where('status', $this::STATUS_ACTIVE);
    }
}
