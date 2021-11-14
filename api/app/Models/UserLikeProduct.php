<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikeProduct extends Model
{
    use HasFactory;
    protected $table = "user_like_products";

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'text',
    ];
}
