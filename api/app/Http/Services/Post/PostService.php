<?php

namespace App\Http\Services\Post;

use App\Http\Services\File\FileService;
use App\Http\Services\User\UserService;
use Validator;
use Illuminate\Http\Request;
use File;
use App\Models\Post;

class PostService
{
    private FileService $fileService;
    private UserService $userService;

    public function __construct(FileService $fileService, UserService $userService)
    {
        $this->fileService = $fileService;
        $this->userService = $userService;
    }

    public function getAllPosts()
    {
        return response()->json(Post::get(), 200);
    }

    public function getPostById($id)
    {

        $post = Post::find($id);
        if (is_null($post)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $post, 'code' => 200];
    }

    public function createPost(Request $req)
    {
        $request = $req->all();
        $request['image'] = $this->fileService->getFilePath($req, 'image');

        $post = Post::create($request);
        return response()->json($post, 201);
    }

    public function postEdit(Request $req, $id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->update($req->all());
        return response()->json($post, 200);
    }

    public function postDelete($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->delete();
        return response()->json('Post was deleted success', 200);
    }

    public function getPostByUserId($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $user, 'code' => $code] = $this->userService->getUserById($id);
        if ($user['error'])
            return response()->json($user, $code);

        return response()->json(Post::where('user_id', $id)->get(), 200);
    }

    public function addViewsToPost($id)
    {
        ['data' => $post, 'code' => $code] = $this->getPostById($id);
        if ($post['error'])
            return response()->json($post, $code);

        $post['views'] = $post['views'] + 1;
        $post->save();

        return response()->json($post, 200);
    }
}
