<?php

namespace App\Http\Services\Post;


use App\Http\Services\Post\PostService;
use App\Http\Services\User\UserService;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentService
{
    private UserService $userService;
    private PostService $postService;

    public function __construct(UserService $userService, PostService $postService)
    {
        $this->userService = $userService;
        $this->postService = $postService;
    }

    public function createPost(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Comment::create($request->all()), 201);
    }

    public function getCommentById($id)
    {
        $comment = Comment::find($id);
        if (is_null($comment)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $comment, 'code' => 200];
    }

    public function getCommentByPostId($id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Comment::where('post_id', $id)->get(),200);
    }

    public function editComment(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $req = $request->all();
        ['data' => $comment, 'code' => $code] = $this->getCommentById($id);
        if ($comment['error'])
            return response()->json($comment, $code);

        $comment->update($req);
        return response()->json($comment, 200);
    }

    public function deleteComment($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $comment, 'code' => $code] = $this->getCommentById($id);
        if ($comment['error'])
            return response()->json($comment, $code);

        $comment->delete();
        return response()->json('Comment was deleted success', 200);
    }
}
