<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductTagService;
use App\Http\Services\Tag\TagService;
use App\Http\Services\Validator\ValidatorService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private TagService $tagService;
    private ProductTagService $productTagService;
    private ValidatorService $validatorService;

    public function __construct(
        TagService $tagService,
        ValidatorService $validatorService,
        ProductTagService $productTagService
    )
    {
        $this->tagService = $tagService;
        $this->productTagService = $productTagService;
        $this->validatorService = $validatorService;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($errors = $this->validatorService->validate($request, [
            'name' => 'required|min:2|max:256|unique:tags',
        ])) return $errors;
        return $this->tagService->createTag($request);
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->tagService->getAllTags();
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $tag, 'code' => $code] = $this->tagService->getTagById($id);
        if ($tag['error'])
            return response()->json($tag, $code);

        return response()->json($tag, 200);
    }

    public function deleteById($id): \Illuminate\Http\JsonResponse
    {
        return $this->tagService->deleteTagById($id);
    }
}
