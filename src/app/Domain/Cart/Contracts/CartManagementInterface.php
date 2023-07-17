<?php

namespace App\Domain\Cart\Contracts;

use App\Domain\Cart\Models\CartItem;

interface CartManagementInterface
{
    public function addToCart(array $data): CartItem;
    public function removeFromCart(int $cartItemId): bool;
    public function getCartItems(): array;
}
