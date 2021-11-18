<?php

namespace App\Http\Services\Product;

use App\Http\Services\User\UserService;
use App\Models\UserLikeProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductLikeCommentService
{
    private ProductService $productService;
    private ProductCommentService $productCommentService;
    private UserService $userService;

    public function __construct(
        ProductService        $productService,
        ProductCommentService $productCommentService,
        UserService           $userService
    )
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
    }

    private function validateLikeRequest($req)
    {
        ['data' => $product, 'code' => $code] = $this->productCommentService->getProductCommentById($req['comment_product_id']);
        if ($product['error'])
            return response()->json($product, $code);

        ['data' => $user, 'code' => $code] = $this->userService->getUserById($req['user_id']);
        if ($user['error'])
            return response()->json($user, $code);

        return 'success';
    }

    private function getExistedLike($req)
    {
        return UserLikeProductComment::
        where('comment_product_id', $req['comment_product_id'])->
        where('user_id', $req['user_id'])->
        first();
    }

    public function likeComment(Request $request)
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

        return response()->json(UserLikeProductComment::create($req), 201);
    }

    public function dislikeComment(Request $request)
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

    public function getLikesTotalCount($id)
    {
       return UserLikeProductComment::
        where('comment_product_id', $id)->count();
    }
}
