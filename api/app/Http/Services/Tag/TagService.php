<?php

namespace App\Http\Services\Tag;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagService
{
    public function createTag(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Tag::create($request->all()), 201);
    }

    public function deleteTagById($id): \Illuminate\Http\JsonResponse
    {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $tag->delete();

        return response()->json(['message' => 'Tag was deleted success'], 200);
    }

    public function getAllTags(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Tag::get(), 200);
    }

    public function getTagById($id): array
    {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $tag, 'code' => 200];
    }
}
