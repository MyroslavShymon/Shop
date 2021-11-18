<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use App\Http\Services\Type\TypeService;
use App\Http\Services\Validator\ValidatorService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private TypeService $typeService;
    private ValidatorService $validatorService;

    public function __construct(TypeService $typeService, ValidatorService $validatorService)
    {
        $this->typeService = $typeService;
        $this->validatorService = $validatorService;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($errors = $this->validatorService->validate($request, [
            'name' => 'required|min:2|max:256|unique:types',
        ])) return $errors;
        return $this->typeService->createType($request);
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->typeService->getAllTypes();
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $type, 'code' => $code] = $this->typeService->getTypeById($id);
        if ($type['error'])
            return response()->json($type, $code);

        return response()->json($type, 200);
    }

    public function deleteById($id): \Illuminate\Http\JsonResponse
    {
        return $this->typeService->deleteTypeById($id);
    }
}
