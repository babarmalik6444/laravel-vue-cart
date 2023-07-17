<?php

namespace App\Domain\Cart\Services;

use App\Domain\Cart\Contracts\CartManagementInterface;
use App\Domain\Cart\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService implements CartManagementInterface
{
    public function addToCart(array $data): CartItem
    {
        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $data['product_id']
            ],
            [
                'user_id' => Auth::id(),
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
            ]
        );

        return $cartItem;
    }

    public function removeFromCart(int $productId): bool
    {
        $cartItem = CartItem::where('product_id', $productId)->where('user_id', Auth::id())->first();

        if (!$cartItem) {
            return false;
        }

        $cartItem->delete();

        return true;
    }

    public function getCartItems(): array
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();

        return $cartItems->toArray();
    }
}

