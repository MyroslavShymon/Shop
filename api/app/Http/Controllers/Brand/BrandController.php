<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Services\Brand\BrandService;
use App\Http\Services\Validator\ValidatorService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private BrandService $brandService;
    private ValidatorService $validatorService;

    public function __construct(BrandService $brandService, ValidatorService $validatorService)
    {
        $this->brandService = $brandService;
        $this->validatorService = $validatorService;
    }

    public function create(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'name' => 'required|min:2|max:256|unique:brands',
            'image' => 'required',
            'description' => 'required',
        ])) return $errors;
        return $this->brandService->createBrand($request);
    }

    public function getAll()
    {
        return $this->brandService->getAllBrands();
    }

    public function getById($id)
    {
        ['data' => $brand, 'code' => $code] = $this->brandService->getBrandById($id);
        if ($brand['error'])
            return response()->json($brand, $code);

        return response()->json($brand, 200);
    }

    public function deleteById($id)
    {
        return $this->brandService->deleteBrandById($id);
    }
}
