<?php

namespace App\Http\Services\Product;

use App\Http\Services\Basket\BasketService;
use App\Models\ProductBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBasketService
{
    private ProductService $productService;
    private BasketService $basketService;

    public function __construct(ProductService $productService, BasketService $basketService)
    {
        $this->productService = $productService;
        $this->basketService = $basketService;
    }

    public function isProductInBasket(Request $request): \Illuminate\Support\Collection
    {
        $req = $request->all();
        return
            DB::table('product_baskets')->
            where('product_id', $req['product_id'])->
            where('basket_id', $req['basket_id'])->
            get();
    }

    public function addProductToBasket(Request $request): \Illuminate\Http\JsonResponse
    {
        ['data' => $product, 'code' => $code] = $this->productService->getProductById($request->product_id);
        if ($product['error'])
            return response()->json($product, $code);

        ['data' => $basket, 'code' => $code] = $this->basketService->getBasketById($request->basket_id);
        if ($basket['error'])
            return response()->json($basket, $code);

        $products = $this->isProductInBasket($request);

        if (count($products) == 0) {
            $product = ProductBasket::create($request->all());
            return response()->json($product, 201);
        };

        return response()->json(['error' => true, 'message' => 'Product is already in basket'], 400);
    }
}
