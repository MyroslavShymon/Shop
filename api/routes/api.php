<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//image
Route::get('image/{filename}', 'Photo\PhotoController@image');

//product
Route::get('product', 'Product\ProductController@getAll');
Route::get('product/{id}', 'Product\ProductController@getById');
Route::get('product/user/{id}', 'Product\ProductController@getByUserId');
Route::get('product/views/{id}', 'Product\ProductController@addViews');
Route::get('product/brand/{id}', 'Product\ProductController@getByBrandId');
Route::get('product/type/{id}', 'Product\ProductController@getByTypeId');
Route::get('product/tag/{id}', 'Product\ProductController@getByTagId');
Route::get('product/comment/{id}', 'Product\ProductController@getComments');
Route::get('product/comment-likes/{id}', 'Product\ProductController@getLikesTotalCount');
Route::post('product/like/comment', 'Product\ProductController@likeComment');
Route::post('product', 'Product\ProductController@create');
Route::post('product/basket', 'Product\ProductController@addToBasket');
Route::post('product/add-tag', 'Product\ProductController@addToProduct');
Route::post('product/comment', 'Product\ProductController@addComment');
Route::delete('product/{id}', 'Product\ProductController@deleteById');
Route::delete('product/dislike/comment', 'Product\ProductController@dislikeComment');

//role
Route::post('role', 'Role\RoleController@create');
Route::get('role/{id}', 'Role\RoleController@getById');
Route::post('role/user/{userId}', 'Role\RoleController@applyToUser');

//brand
Route::post('brand', 'Brand\BrandController@create');
Route::get('brand', 'Brand\BrandController@getAll');
Route::get('brand/{id}', 'Brand\BrandController@getById');
Route::delete('brand/{id}', 'Brand\BrandController@deleteById');

//type
Route::post('type', 'Type\TypeController@create');
Route::get('type', 'Type\TypeController@getAll');
Route::get('type/{id}', 'Type\TypeController@getById');
Route::delete('type/{id}', 'Type\TypeController@deleteById');

//Tag
Route::post('tag', 'Tag\TagController@create');
Route::get('tag', 'Tag\TagController@getAll');
Route::get('tag/{id}', 'Tag\TagController@getById');
Route::delete('tag/{id}', 'Tag\TagController@deleteById');

//type
//Route::post('type', 'Type\TypeController@create');


////posts
//
//Route::group(['middleware' => ['jwt.verify']], function() {
//    Route::get('posts', 'Post\PostController@post');
//});
//Route::get('posts/{id}', 'Post\PostController@postById');
//Route::get('posts/category/{id}', 'Post\PostController@postByCategoryId');
//
//Route::post('posts', 'Post\PostController@postSave');
//Route::post('posts/like/{id}', 'Post\PostController@likePost');
//
//Route::put('posts/{id}', 'Post\PostController@postEdit');
//
//Route::delete('posts/{id}', 'Post\PostController@postDelete');
//
////comment
//Route::get('comment/{id}', 'Comment\CommentController@commentByPostId');
//
//Route::post('comment', 'Comment\CommentController@commentSave');
//Route::post('comment/like/{id}', 'Comment\CommentController@likeComment');
//
//Route::put('comment/{id}', 'Comment\CommentController@commentEdit');
//
//Route::delete('comment/{id}', 'Comment\CommentController@commentDelete');
//
////category
//Route::get('category', 'Category\CategoryController@category');
//
//Route::post('category', 'Category\CategoryController@categorySave');

//user
Route::post('auth/registration', 'User\UserController@registration');
Route::post('auth/login', 'User\UserController@login');
Route::get('get-users', 'User\UserController@get_user');
