<?php

namespace App\Http\Services\Product;

use App\Http\Services\Product\ProductService;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;

class ProductUserValidate
{
    private ProductService $productService;
    private UserService $userService;

    public function __construct(ProductService $productService, UserService $userService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function validate( $req)
    {
        ['data' => $product, 'code' => $code] = $this->productService->getProductById($req['product_id']);
        if ($product['error'])
            return response()->json($product, $code);

        ['data' => $user, 'code' => $code] = $this->userService->getUserById($req['user_id']);
        if ($user['error'])
            return response()->json($user, $code);

        return 'success';
    }
}
