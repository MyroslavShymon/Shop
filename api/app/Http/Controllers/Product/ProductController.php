<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Product\ProductBasketService;
use App\Http\Services\Product\ProductBrandService;
use App\Http\Services\Product\ProductTypeService;
use App\Http\Services\Validator\ValidatorService;
use ClassTransformer\ClassTransformer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductService $productService;
    private ValidatorService $validatorService;
    private ProductBasketService $productBasketService;
    private ProductBrandService $productBrandService;
    private ProductTypeService $productTypeService;

    public function __construct(
        ProductService       $productService,
        ValidatorService     $validatorService,
        ProductBasketService $productBasketService,
        ProductBrandService  $productBrandService,
        ProductTypeService   $productTypeService
    )
    {
        $this->productBasketService = $productBasketService;
        $this->validatorService = $validatorService;
        $this->productService = $productService;
        $this->productBrandService = $productBrandService;
        $this->productTypeService = $productTypeService;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
//        $dto = ClassTransformer::transform(CreateProductDto::class, $request);
        if ($errors = $this->validatorService->validate($request, [
            'name' => 'required|min:2|max:256|unique:products',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'user_id' => 'required',
            'brand_id' => 'required',
            'type_id' => 'required',
        ])) return $errors;
        return $this->productService->createProduct($request);
    }

    public function deleteById($id): \Illuminate\Http\JsonResponse
    {
        return $this->productService->deleteProductById($id);
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->productService->getAllProducts();
    }

    public function getByUserId($id): \Illuminate\Http\JsonResponse
    {
        return $this->productService->getAllProductsByUserId($id);
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        ['data' => $product, 'code' => $code] = $this->productService->getProductById($id);
        if ($product['error'])
            return response()->json($product, $code);

        return response()->json($product, 200);
    }

    public function addToBasket(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'basket_id' => 'required',
            'product_id' => 'required',
        ])) return $errors;

        return $this->productBasketService->addProductToBasket($request);
    }

    public function addViews($id)
    {
        return $this->productService->addViewsToProduct($id);
    }

    public function getByBrandId($id)
    {
        return $this->productBrandService->getProductsByBrandId($id);
    }

    public function getByTypeId($id)
    {
        return $this->productTypeService->getProductsWithType($id);
    }
}
