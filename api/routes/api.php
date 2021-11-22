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

//список всіх сторінок
//лінта 12
//товару 2
//головна 1
//бренду 8
//тегу 9
//типу продукту 10
//список друзів 11
//соорінка збережених товарів 13
//користувача 3
//посту 4
//друзів 5
//повідомлення 6
//сторінка списку всіх брендів 7
//
//Адмінка
//ролі 14
//бренду 15
//тип 16


// сторінки на яких відображається товар: головна сторінка, сторінка лінти, сторінка користувача, сторінка товару, бренду, тегу, типу
// всі сторінки на яких можна подивитись коментарі під продуктом: сторінка лінти, сторінка користувача, сторінка товару
//сторінки на яких відображається пост: головна лінта та сторінка користувача та сторінка кокреторного поста

//product
Route::get('product', 'Product\ProductController@getAll');//головна сторінка
Route::get('product/in-basket/{id}', 'Product\ProductController@getProductsInBasket');//головна сторінка
Route::get('product/{id}', 'Product\ProductController@getById');//сторінка товару
Route::get('product/user/{id}', 'Product\ProductController@getByUserId');//сторінка користувача
Route::get('product/views/{id}', 'Product\ProductController@addViews');//додати прегляди до продуктів
Route::get('product/brand/{id}', 'Product\ProductController@getByBrandId');//сторінка бренда
Route::get('product/type/{id}', 'Product\ProductController@getByTypeId');//сторінка типу
Route::get('product/tag/{id}', 'Product\ProductController@getByTagId');//сторінка товарів за тегом
Route::get('product/comment/{id}', 'Product\ProductController@getComments');//сторінка товару получити коменти під продукто з id
Route::get('product/comment-likes/{id}', 'Product\ProductController@getLikesTotalCount');//сторінка товару кількість лайків під коментарем товаром
Route::get('product/save/{id}', 'Product\ProductController@getLikedProducts');//сторінка збереженого...получити збережені товари користувачів !!!
Route::post('product/is/basket', 'Product\ProductController@isProductInBasket');//чи продукт в корзині
Route::post('product/add-tag', 'Product\ProductController@addToProduct');//добавити тег до товара ... сторінка користувача
Route::post('product/like/comment', 'Product\ProductController@likeComment');//сторінка товару лайкнути коментар
Route::post('product', 'Product\ProductController@create');//сторінка користувача ... дорати продукт
Route::post('product/basket', 'Product\ProductController@addToBasket');//головна сторінка або сторінка конкретного товару  ... додати товар до кошика
Route::post('product/comment', 'Product\ProductController@addComment');//додати комент до продукта ... на сторінці користувача або на сторінці товару або на головній стрічці
Route::post('product/save', 'Product\ProductController@likeProducts');//додати до збережених товар ... на всіх сторінках на яких відображається товар
Route::delete('product/{id}', 'Product\ProductController@deleteById');//видалити товар ... на всіх сторінках на яких відображається товар
Route::delete('product/save/remove', 'Product\ProductController@dislikeProducts');//видалаити зі збережених ... на всіх сторінках на яких відображається товар
Route::delete('product/dislike/comment', 'Product\ProductController@dislikeComment');//відізвати лайк з коменту під продуктом ... всі сторінки на яких можна подивитись коментарі під продуктом
Route::post('product/remove/basket', 'Product\ProductController@removeFromBasket');//видалити з корзини

//role
Route::post('role', 'Role\RoleController@create');//додати роль ... сторінка ролі
Route::get('role/{id}', 'Role\RoleController@getById');//получити аідомості про роль ... сторінка ролі
Route::post('role/user/{userId}', 'Role\RoleController@applyToUser');//додати користувачу роль ... сторінка ролі

//brand
Route::post('brand', 'Brand\BrandController@create');//додати бренд ... сторінка бренду для адміна
Route::get('brand', 'Brand\BrandController@getAll');//получити всі бренди ... сторінка бренду для адміна і сторінка зі всіма пристуніми брендами
Route::get('brand/{id}', 'Brand\BrandController@getById');//получити дані про бренд ... сторінка бренду
Route::delete('brand/{id}', 'Brand\BrandController@deleteById');//видалити бренд ... сторінка бренду для адиіна

//type
Route::post('type', 'Type\TypeController@create');//додати тип ... сторінка типу для адміна
Route::get('type', 'Type\TypeController@getAll');//получити всі типи ... головна сторінка то сторінка типу для адміна
Route::get('type/{id}', 'Type\TypeController@getById');//полчити тип ... сторінка типу
Route::delete('type/{id}', 'Type\TypeController@deleteById');//видалити тип ... сторінка типу для адміна

//tag
Route::post('tag', 'Tag\TagController@create');//додати тег ... при створені товару
Route::get('tag', 'Tag\TagController@getAll');//получити всі теги ... сторінка головна
Route::get('tag/{id}', 'Tag\TagController@getById');//сторінка тегу інформація про тег
Route::delete('tag/{id}', 'Tag\TagController@deleteById');//видалити тег сторінка тегу адміністратора

//rating
Route::post('rating', 'Product\ProductController@addRating');//добавити рейтинг ... якшо товар придбаний ... на сторінці товару
Route::get('rating/{id}', 'Product\ProductController@getProductRating');//відобразити середній рейтинг ... на всіх сторінках на яких відображається товар


//type
//Route::post('type', 'Type\TypeController@create');


//posts
//Route::group(['middleware' => ['jwt.verify']], function() {
/**
 * @OA\Get(
 *     path="/",
 *     description="Home page",
 *     @OA\Response(response="default", description="Welcome page dd")
 * )
 */
Route::get('post', 'Post\PostController@getAll');//получити всі пости ... якщо користувач ні на кого не підписаний то відображати їх ... головна лінта
//});
Route::get('post/{id}', 'Post\PostController@postById');//конкретний пост ... сторінка посту
Route::get('post/views/{id}', 'Post\PostController@addViews');//добавити перегляд
Route::get('post/user/{id}', 'Post\PostController@getByUserId');//получити пости конкретної людини ... сторінка користуваача
//Route::get('post/category/{id}', 'Post\PostController@postByCategoryId');
Route::post('post', 'Post\PostController@postSave');// створити пост ... сторінка користувача
//Route::post('post/like/{id}', 'Post\PostController@likePost');
Route::put('post/{id}', 'Post\PostController@postEdit');// змінити пост ... сторінка кормстувача
Route::delete('post/{id}', 'Post\PostController@postDelete');// видалити пост ... стрінка користувача

//posts like
Route::delete('post-dislike', 'Post\PostController@dislikePost');//?????????????????шоб пхп здох// дизлайкнути пост ... на всіх сторінках на яких відображається пост
Route::post('post/like', 'Post\PostController@likePost');// лайкнути пост ... на всіх сторінках на яких відображається пост
Route::get('post/likes/{id}', 'Post\PostController@getLikesTotalCount');// получити  ... на всіх сторінках на яких відображається пост

//comment
Route::get('comment/{id}', 'Comment\CommentController@getById');//получити конкретний комент
Route::get('comment/post/{id}', 'Comment\CommentController@getByPostId');//коменти до поста ... на всіх сторінках на яких відображається пост
Route::post('comment', 'Comment\CommentController@add');//добавити комент до поста ... на всіх сторінках на яких відображається пост
//Route::post('comment/like/{id}', 'Comment\CommentController@likeComment');
Route::put('comment/{id}', 'Comment\CommentController@commentEdit');//змінити комент ... на всіх сторінках на яких відображається пост
Route::delete('comment/{id}', 'Comment\CommentController@commentDelete');//видалити комент ... на всіх сторінках на яких відображається пост

//friends
Route::post('friend', 'Friend\FriendController@add');// добавити друга ... сторнка кориситувача
Route::delete('friend', 'Friend\FriendController@remove');// видалити друга ... сторнка друзів та кориситувача
Route::get('friend/{id}', 'Friend\FriendController@getFriends');// вивести друзів ... користувача сторінка друзів

//messages
Route::post('message', 'Message\MessageController@send');//добавити повідомлення ... сторінка повідомлень
Route::delete('message/{id}', 'Message\MessageController@delete');//видалити повідомлення ... сторінка повідомлень


////category
//Route::get('category', 'Category\CategoryController@category');
//
//Route::post('category', 'Category\CategoryController@categorySave');

//user
Route::post('auth/registration', 'User\UserController@registration');//
Route::post('auth/login', 'User\UserController@login');//
Route::get('get-users', 'User\UserController@get_user');//
