<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductCommentService;
use App\Http\Services\Product\ProductLikeCommentService;
use App\Http\Services\Product\ProductRatingService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Product\ProductBasketService;
use App\Http\Services\Product\ProductBrandService;
use App\Http\Services\Product\ProductTagService;
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
    private ProductTagService $productTagService;
    private ProductCommentService $productCommentService;
    private ProductLikeCommentService $productLikeCommentService;
    private ProductRatingService $productRatingService;

    public function __construct(
        ProductService            $productService,
        ValidatorService          $validatorService,
        ProductBasketService      $productBasketService,
        ProductBrandService       $productBrandService,
        ProductTypeService        $productTypeService,
        ProductTagService         $productTagService,
        ProductCommentService     $productCommentService,
        ProductLikeCommentService $productLikeCommentService,
        ProductRatingService      $productRatingService
    )
    {
        $this->productBasketService = $productBasketService;
        $this->validatorService = $validatorService;
        $this->productService = $productService;
        $this->productBrandService = $productBrandService;
        $this->productTypeService = $productTypeService;
        $this->productTagService = $productTagService;
        $this->productCommentService = $productCommentService;
        $this->productLikeCommentService = $productLikeCommentService;
        $this->productRatingService = $productRatingService;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
//        $dto = ClassTransformer::transform(CreateProductDto::class, $request);
        if ($errors = $this->validatorService->validate($request, [
            'name' => 'required|min:2|max:256|unique:products',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'user_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'type_id' => 'required|numeric',
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
            'basket_id' => 'required|numeric',
            'product_id' => 'required|numeric',
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

    public function getByTagId($id)
    {
        return $this->productTagService->getProductsWithTag($id);
    }

    public function addToProduct(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'tag_id' => 'required|numeric',
            'product_id' => 'required|numeric',
        ])) return $errors;

        return $this->productTagService->addTagToProduct($request);
    }

    public function addComment(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'text' => 'required|max:256',
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
        ])) return $errors;

        return $this->productCommentService->addCommentToProduct($request);
    }

    public function getComments($id): \Illuminate\Support\Collection
    {
        return $this->productCommentService->getProductComments($id);
    }

    public function likeComment(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id' => 'required|numeric',
            'comment_product_id' => 'required|numeric',
        ])) return $errors;

        return $this->productLikeCommentService->likeComment($request);
    }

    public function dislikeComment(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id' => 'required|numeric',
            'comment_product_id' => 'required|numeric',
        ])) return $errors;

        return $this->productLikeCommentService->dislikeComment($request);
    }

    public function getLikesTotalCount($id)
    {
        return $this->productLikeCommentService->getLikesTotalCount($id);
    }

    public function addRating(Request $request)
    {
        if ($errors = $this->validatorService->validate($request, [
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'rate' => 'max:5|min:1|required|numeric',
        ])) return $errors;
       return $this->productRatingService->addRating($request);
    }

    public function getProductRating($id): \Illuminate\Http\JsonResponse
    {
        return $this->productRatingService->getTotalRatingOfProduct($id);
    }
}
