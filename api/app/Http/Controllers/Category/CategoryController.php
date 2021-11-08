<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Models\CategoryModel;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function category(): \Illuminate\Http\JsonResponse
    {
        return response()->json(CategoryModel::get(), 200);
    }

    public function categorySave(Request $req): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category = CategoryModel::create($req->all());
        return response()->json($category, 201);
    }
}
