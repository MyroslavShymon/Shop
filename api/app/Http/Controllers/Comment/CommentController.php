<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Models\CommentModel;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{
    public function commentByPostId($id): \Illuminate\Http\JsonResponse
    {
        $comment = CommentModel::where('post_id', $id)->get();

        if (is_null($comment)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        return response()->json($comment, 200);
    }

    public function commentSave(Request $req): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'text' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment = CommentModel::create($req->all());
        return response()->json($comment, 201);
    }

    public function likeComment($id): \Illuminate\Http\JsonResponse
    {
        $comment = CommentModel::find($id);
        if (is_null($comment)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $comment["likes"] = $comment["likes"] + 1;
        $comment->save();
        return response()->json($comment, 200);
    }

    public function commentEdit(Request $req, $id): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'text' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $comment = CommentModel::find($id);
        if (is_null($comment)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $comment->update($req->all());
        return response()->json($comment, 200);
    }

    public function commentDelete(Request $req, $id): \Illuminate\Http\JsonResponse
    {
        $comment = CommentModel::find($id);
        if (is_null($comment)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $comment->delete();
        return response()->json('', 204);
    }
}
