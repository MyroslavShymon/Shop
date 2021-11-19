<?php

namespace App\Http\Services\Product;

use App\Http\Services\User\UserService;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRatingService
{
    private ProductService $productService;
    private UserService $userService;
    private ProductUserValidate $productUserValidate;

    public function __construct(
        ProductService      $productService,
        UserService         $userService,

        ProductUserValidate $productUserValidate)
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->productUserValidate = $productUserValidate;
    }

    private function getExistedRating($req)
    {
        return Rating::
        where('product_id', $req['product_id'])->
        where('user_id', $req['user_id'])->
        first();
    }

    public function addRating(Request $request)
    {
        $req = $request->all();

        $valid = $this->productUserValidate->validate($req);
        if ($valid != 'success') {
            return $valid;
        }

        $rating = $this->getExistedRating($req);
        if ($rating) {
            return response()->json(['error' => true, 'message' => 'Rating already added'], 400);
        }

        return response()->json(Rating::create($req), 201);
    }

    public function getTotalRatingOfProduct($id)
    {
        return response()->json(
            DB::table('ratings')->
            where('product_id', $id)->
            avg('rate')
        );
    }
}
