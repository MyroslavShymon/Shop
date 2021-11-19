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
    private ProductUserValidate $productUserValidate;

    public function __construct(
        ProductService $productService,
        UserService $userService,
        ProductUserValidate $productUserValidate
    )
    {
        $this->productService = $productService;
        $this->userService = $userService;
        $this->productUserValidate = $productUserValidate;
    }

    public function addCommentToProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $req = $request->all();

        $valid = $this->productUserValidate->validate($req);
        if ($valid != 'success') {
            return $valid;
        }

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
