<?php

namespace App\Http\Services\Product;

use App\Http\Services\Tag\TagService;
use App\Http\Services\User\UserService;
use App\Models\CommentProduct;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCommentService
{
    private ProductService $productService;
    private UserService $userService;

    public function __construct(ProductService $productService, UserService $userService)
    {
        $this->productService = $productService;
        $this->userService = $userService;
    }

    public function addCommentToProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $req = $request->all();

        ['data' => $product, 'code' => $code] = $this->productService->getProductById($req['product_id']);
        if ($product['error'])
            return response()->json($product, $code);

        ['data' => $user, 'code' => $code] = $this->userService->getUserById($req['user_id']);
        if ($user['error'])
            return response()->json($user, $code);

        return response()->json(CommentProduct::create($req), 201);
    }

    public function getProductComments($id): \Illuminate\Support\Collection
    {
        return
            DB::table('comment_products')->
            where('product_id', $id)->
            get();
    }

    public function getProductCommentById($id): array
    {
        $comment = CommentProduct::find($id);
        if (is_null($comment)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $comment, 'code' => 200];
    }
}
