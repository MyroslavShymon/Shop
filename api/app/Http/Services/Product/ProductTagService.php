<?php

namespace App\Http\Services\Product;

use App\Http\Services\Tag\TagService;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTagService
{
    private TagService $tagService;
    private ProductService $productService;

    public function __construct(TagService $tagService, ProductService $productService)
    {
        $this->tagService = $tagService;
        $this->productService = $productService;
    }

    public function getProductsWithTag($id)
    {
        ['data' => $tag, 'code' => $code] = $this->tagService->getTagById($id);
        if ($tag['error'])
            return response()->json($tag, $code);

        return
            DB::table('product_tags')->
            where('tag_id', $id)->
            leftJoin('products', 'product_tags.product_id', '=', 'products.id')->
            select('products.*')->
            get();
    }

    private function isProductWithTag(Request $request)
    {
        $req = $request->all();
        return
            DB::table('product_tags')->
            where('product_id', $req['product_id'])->
            where('tag_id', $req['tag_id'])->
            get();
    }

    public function addTagToProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $req = $request->all();

        ['data' => $product, 'code' => $code] = $this->productService->getProductById($req['product_id']);
        if ($product['error'])
            return response()->json($product, $code);

        ['data' => $tag, 'code' => $code] = $this->tagService->getTagById($req['tag_id']);
        if ($tag['error'])
            return response()->json($tag, $code);

        $products = $this->isProductWithTag($request);

        if (count($products) == 0) {
            $product = ProductTag::create($req);
            return response()->json($product, 201);
        };

        return response()->json(['error' => true, 'message' => 'Product is already with this tag'], 400);
    }
}
