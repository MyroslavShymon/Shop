<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(30)->create();
        \App\Models\Brand::factory(30)->create();
        \App\Models\Type::factory(30)->create();
        \App\Models\Basket::factory(30)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Post::factory(50)->create();
        \App\Models\Role::factory(5)->create();
        \App\Models\Tag::factory(50)->create();
        \App\Models\Comment::factory(50)->create();
        \App\Models\Rating::factory(50)->create();
        \App\Models\Like::factory(50)->create();
        \App\Models\ProductTag::factory(50)->create();
        \App\Models\ProductBasket::factory(50)->create();
        \App\Models\UserRole::factory(30)->create();
        \App\Models\CommentProduct::factory(50)->create();
        \App\Models\UserLikeProduct::factory(50)->create();
        \App\Models\UserLikeProductComment::factory(50)->create();
    }
}
