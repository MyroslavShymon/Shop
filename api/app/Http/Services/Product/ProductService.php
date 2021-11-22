<?php

namespace App\Http\Services\Product;

use App\Http\Services\File\FileService;
use Illuminate\Http\Request;
use File;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductService
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function createProduct(Request $req): \Illuminate\Http\JsonResponse
    {
        $request = $req->all();
        $request['image'] = $this->fileService->getFilePath($req, 'image');

        $product = Product::create($request);
        return response()->json($product, 201);
    }

    public function deleteProductById($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $product->delete();

        return response()->json(['message' => 'Message was deleted success'], 200);
    }

    public function getAllProducts(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Product::get(), 200);
    }

    public function getProductsInBasket($id)
    {
        return response()->json(DB::table('products')->
        leftJoin('product_baskets', 'products.id', '=', 'product_baskets.product_id')->
        where('product_baskets.basket_id', $id)->
        select('products.*', 'product_baskets.*')->
        get(), 200);
    }

    public function getAllProductsByUserId($id): \Illuminate\Http\JsonResponse
    {
        $products = Product::where('user_id', $id)->get();
        return response()->json($products, 200);
    }

    public function getProductById($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return ['data' => ['error' => true, 'message' => 'Not found'], 'code' => 404];
        };
        return ['data' => $product, 'code' => 200];
    }

    public function addViewsToProduct($id)
    {
        ['data' => $product, 'code' => $code] = $this->getProductById($id);
        if ($product['error'])
            return response()->json($product, $code);

        $product['views'] = $product['views'] + 1;
        $product->save();

        return ['data' => $product, 'code' => 200];
    }
}
