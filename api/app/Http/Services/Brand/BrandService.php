<?php

namespace App\Http\Services\Brand;

use App\Http\Services\File\FileService;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandService
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function createBrand(Request $req): \Illuminate\Http\JsonResponse
    {
        $request = $req->all();
        $request['image'] = $this->fileService->getFilePath($req, 'image');

        $brand = Brand::create($request);

        return response()->json($brand, 201);
    }

    public function deleteBrandById($id): \Illuminate\Http\JsonResponse
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $brand->delete();

        return response()->json(['message' => 'Brand was deleted success'], 200);
    }

    public function getAllBrands(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Brand::get(), 200);
    }

    public function getBrandById($id): array
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $brand, 'code' => 200];
    }
}
