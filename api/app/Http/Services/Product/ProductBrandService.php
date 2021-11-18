<?php

namespace App\Http\Services\Product;

use App\Http\Services\Brand\BrandService;
use Illuminate\Support\Facades\DB;

class ProductBrandService
{
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function getProductsByBrandId($id)
    {
        ['data' => $brand, 'code' => $code] = $this->brandService->getBrandById($id);
        if ($brand['error'])
            return response()->json($brand, $code);

        return
            DB::table('products')->
            where('brand_id', $id)->
            get();
    }
}
