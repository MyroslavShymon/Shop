<?php

namespace App\Http\Services\Product;

use App\Http\Services\User\UserService;
use App\Models\UserLikeProduct;
use Illuminate\Http\Request;

class ProductUserLikeService
{
    private UserService $userService;
    private ProductService $productService;

    public function __construct(
        UserService $userService,
        ProductService $productService
    )
    {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    private function validateLikeRequest($req)
    {
        ['data' => $product, 'code' => $code] = $this->productService->getProductById($req['product_id']);
        if ($product['error'])
            return response()->json($product, $code);

        ['data' => $user, 'code' => $code] = $this->userService->getUserById($req['user_id']);
        if ($user['error'])
            return response()->json($user, $code);

        return 'success';
    }

    private function getExistedLike($req)
    {
        return UserLikeProduct::
        where('product_id', $req['product_id'])->
        where('user_id', $req['user_id'])->
        first();
    }

    public function likeProduct(Request $request)
    {
        $req = $request->all();
        $valid = $this->validateLikeRequest($req);
        if ($valid != 'success') {
            return $valid;
        }

        $like = $this->getExistedLike($req);
        if ($like) {
            return response()->json(['error' => true, 'message' => 'Like already exist'], 400);
        }

        return response()->json(UserLikeProduct::create($req), 201);
    }

    public function dislikeProduct(Request $request)
    {
        $req = $request->all();
        $valid = $this->validateLikeRequest($req);
        if ($valid != 'success') {
            return $valid;
        }

        $like = $this->getExistedLike($req);
        if (is_null($like)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $like->delete();

        return response()->json('Disliked was success', 200);
    }

    public function getLikedProducts($id)
    {
        return UserLikeProduct::
        where('user_id', $id)->get();
    }
}
