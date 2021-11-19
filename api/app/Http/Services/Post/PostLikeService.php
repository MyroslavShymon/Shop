<?php

namespace App\Http\Services\Post;

use App\Http\Services\User\UserService;
use App\Models\UserLikePost;
use Illuminate\Http\Request;

class PostLikeService{
    private UserService $userService;
    private PostService $postService;

    public function __construct(
        UserService           $userService,
        PostService $postService
    )
    {
        $this->userService = $userService;
        $this->postService = $postService;
    }

    private function validateLikeRequest($req)
    {
        ['data' => $post, 'code' => $code] = $this->postService->getPostById($req['post_id']);
        if ($post['error'])
            return response()->json($post, $code);

        ['data' => $user, 'code' => $code] = $this->userService->getUserById($req['user_id']);
        if ($user['error'])
            return response()->json($user, $code);

        return 'success';
    }

    private function getExistedLike($req)
    {
        return UserLikePost::
        where('post_id', $req['post_id'])->
        where('user_id', $req['user_id'])->
        first();
    }

    public function likePost(Request $request)
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

        return response()->json(UserLikePost::create($req), 201);
    }

    public function dislikePost(Request $request)
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
        return UserLikePost::
        where('post_id', $id)->count();
    }
}
