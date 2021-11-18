<?php

namespace App\Http\Services\Basket;

use App\Models\Basket;

class BasketService
{
    public function createBasket($user_id)
    {
        return Basket::create([
            'user_id' => $user_id
        ]);
    }

    public function getBasketById($id): array
    {
        $basket = Basket::find($id);
        if (is_null($basket)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $basket, 'code' => 200];
    }
}
