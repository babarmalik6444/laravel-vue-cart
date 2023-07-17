<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Cart\Contracts\CartManagementInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Domain\Cart\Requests\AddItemRequest;

class CartController extends Controller
{
    public function __construct(
        private CartManagementInterface $cartService
    ) {}

    public function addToCart(AddItemRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cartItem = $this->cartService->addToCart($data);

        return response()->json(['message' => 'Item added to cart successfully', 'data' => $cartItem]);
    }

    public function removeFromCart(int $cartItemId): JsonResponse
    {
        $result = $this->cartService->removeFromCart($cartItemId);

        if ($result) {
            return response()->json(['message' => 'Item removed from cart successfully']);
        }

        return response()->json(['message' => 'Item not found in cart'], 404);
    }

    public function getCartItems(): JsonResponse
    {
        $cartItems = $this->cartService->getCartItems();

        return response()->json(['data' => $cartItems]);
    }
}

