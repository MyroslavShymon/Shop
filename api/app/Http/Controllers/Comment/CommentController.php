<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Services\Post\PostCommentService;
use App\Http\Services\Validator\ValidatorService;
use App\Models\Models\CommentModel;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{
    private PostCommentService $postCommentService;
    private ValidatorService $validatorService;

    public function __construct(PostCommentService $postCommentService, ValidatorService $validatorService)
    {
        $this->postCommentService = $postCommentService;
        $this->validatorService = $validatorService;
    }

    public function add(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'text' => 'required',
            'user_id' => 'required|numeric',
            'post_id' => 'required|numeric',
        ])) return $errors;

        return $this->postCommentService->createPost($request);
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $comment, 'code' => $code] = $this->postCommentService->getCommentById($id);
        if ($comment['error'])
            return response()->json($comment, $code);

        return response()->json($comment, 200);
    }

    public function getByPostId($id): \Illuminate\Http\JsonResponse
    {
        return $this->postCommentService->getCommentByPostId($id);
    }

//    public function likeComment($id): \Illuminate\Http\JsonResponse
//    {
//        $comment = CommentModel::find($id);
//        if (is_null($comment)) {
//            return response()->json(['error' => true, 'message' => 'Not found'], 404);
//        }
//        $comment["likes"] = $comment["likes"] + 1;
//        $comment->save();
//        return response()->json($comment, 200);
//    }

    public function commentEdit(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        if ($errors = $this->validatorService->validate($request, [
            'text' => 'required',
        ])) return $errors;

        return $this->postCommentService->editComment($request, $id);
    }

    public function commentDelete($id): \Illuminate\Http\JsonResponse
    {
        return $this->postCommentService->deleteComment($id);
    }
}
