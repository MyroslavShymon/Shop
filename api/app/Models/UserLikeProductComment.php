<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikeProductComment extends Model
{
    use HasFactory;
    protected $table = "user_like_product_comments";

    protected $fillable = [
        'id',
        'user_id',
        'comment_product_id',
    ];
}
