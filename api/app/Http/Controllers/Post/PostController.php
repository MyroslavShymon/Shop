<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use App\Models\Models\PostModel;
use Illuminate\Support\Facades\Response;
use Validator;

class PostController extends Controller
{
    public function post(): \Illuminate\Http\JsonResponse
    {
        return response()->json(PostModel::get(), 200);
    }

    public function postById($id): \Illuminate\Http\JsonResponse
    {
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post["views"] = $post["views"] + 1;
        $post->save();
        return response()->json($post, 200);
    }

    public function likePost($id): \Illuminate\Http\JsonResponse
    {
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post["likes"] = $post["likes"] + 1;
        $post->save();
        return response()->json($post, 200);
    }

    public function postSave(Request $req): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'title' => 'required|min:3|max:256',
            'description' => 'required|min:10',
            'category_id' => 'required',
            'user_id' => 'required',
            'image' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!$req->hasFile('image')) {
            error_log("1" . $req->hasFile('image'));
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $req->file('image');
        if (!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $path = public_path() . '/uploads/images/';

        $file->move($path, $file->getClientOriginalName());
        $filepath = "/api/image/" . $file->getClientOriginalName();
        $request = $req->all();
        $request['image'] = $filepath;

        $post = PostModel::create($request);
        return response()->json($post, 201);
    }

    public function postEdit(Request $req, $id): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'title' => 'min:3|max:256',
            'description' => 'min:10',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->update($req->all());
        return response()->json($post, 200);
    }

    public function postDelete(Request $req, $id)
    {
        $post = PostModel::find($id);
        if (is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $post->delete();
        return response()->json('', 204);
    }
}
