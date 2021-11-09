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
Route::get('image/{filename}','Photo\PhotoController@image');

//posts

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('posts', 'Post\PostController@post');
});
Route::get('posts/{id}', 'Post\PostController@postById');
Route::get('posts/category/{id}', 'Post\PostController@postByCategoryId');

Route::post('posts', 'Post\PostController@postSave');
Route::post('posts/like/{id}', 'Post\PostController@likePost');

Route::put('posts/{id}', 'Post\PostController@postEdit');

Route::delete('posts/{id}', 'Post\PostController@postDelete');

//comment
Route::get('comment/{id}', 'Comment\CommentController@commentByPostId');

Route::post('comment', 'Comment\CommentController@commentSave');
Route::post('comment/like/{id}', 'Comment\CommentController@likeComment');

Route::put('comment/{id}', 'Comment\CommentController@commentEdit');

Route::delete('comment/{id}', 'Comment\CommentController@commentDelete');

//category
Route::get('category', 'Category\CategoryController@category');

Route::post('category', 'Category\CategoryController@categorySave');

//user
Route::post('auth/registration', 'User\UserController@registration');
Route::post('auth/login', 'User\UserController@login');
