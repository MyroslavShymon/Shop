<?php

namespace App\Http\Services\Type;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeService
{
    public function createType(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(Type::create($request->all()), 201);
    }

    public function deleteTypeById($id): \Illuminate\Http\JsonResponse
    {
        $type = Type::find($id);
        if (is_null($type)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $type->delete();

        return response()->json(['message' => 'Type was deleted success'], 200);
    }

    public function getAllTypes(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Type::get(), 200);
    }

    public function getTypeById($id): array
    {
        $type = Type::find($id);
        if (is_null($type)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $type, 'code' => 200];
    }
}
