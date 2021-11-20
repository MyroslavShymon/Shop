<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Services\Post\PostLikeService;
use App\Http\Services\Post\PostService;
use App\Http\Services\Validator\ValidatorService;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use App\Models\Models\PostModel;
use Illuminate\Support\Facades\Response;
use Validator;

class PostController extends Controller
{
    private ValidatorService $validatorService;
    private PostService $postService;
    private PostLikeService $postLikeService;

    public function __construct(
        ValidatorService $validatorService,
        PostService      $postService,
        PostLikeService  $postLikeService
    )
    {
        $this->postLikeService = $postLikeService;
        $this->validatorService = $validatorService;
        $this->postService = $postService;
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->postService->getAllPosts();
    }

    public function postById($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $post, 'code' => $code] = $this->postService->getPostById($id);
        if ($post['error'])
            return response()->json($post, $code);

        return response()->json($post, 200);
    }

//    public function likePost($id): \Illuminate\Http\JsonResponse
//    {
//        $post = PostModel::find($id);
//        if (is_null($post)) {
//            return response()->json(['error' => true, 'message' => 'Not found'], 404);
//        }
//        $post["likes"] = $post["likes"] + 1;
//        $post->save();
//        return response()->json($post, 200);
//    }

    public function postSave(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($errors = $this->validatorService->validate($request, [
            'title' => 'required|min:3|max:256',
            'description' => 'required|min:10',
            'product_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'image' => 'required',
        ])) return $errors;
        return $this->postService->createPost($request);
    }

    public function getByUserId($id): \Illuminate\Http\JsonResponse
    {
        return $this->postService->getPostByUserId($id);
    }

    public function postEdit(Request $req, $id): \Illuminate\Http\JsonResponse
    {
        if ($errors = $this->validatorService->validate($req, [
            'title' => 'min:3|max:256',
            'description' => 'min:10',
        ])) return $errors;
        return $this->postService->postEdit($req, $id);
    }

    public function postDelete($id)
    {
        return $this->postService->postDelete($id);
    }

    public function likePost(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id' => 'required|numeric',
            'post_id' => 'required|numeric',
        ])) return $errors;

        return $this->postLikeService->likePost($request);

    }

    public function dislikePost(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id' => 'required|numeric',
            'post_id' => 'required|numeric',
        ])) return $errors;
        return $this->postLikeService->dislikePost($request);

    }

    public function getLikesTotalCount($id)
    {
        return $this->postLikeService->getLikesTotalCount($id);
    }
}
