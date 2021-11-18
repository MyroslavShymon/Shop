<?php

namespace App\Http\Services\Product;

use App\Http\Services\Type\TypeService;
use Illuminate\Support\Facades\DB;

class ProductTypeService
{
    private TypeService $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    public function getProductsWithType($id)
    {
        ['data' => $type, 'code' => $code] = $this->typeService->getTypeById($id);
        if ($type['error'])
            return response()->json($type, $code);

        return
            DB::table('products')->
            where('type_id', $id)->
            get();
    }
}
