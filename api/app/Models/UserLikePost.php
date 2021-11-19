<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikePost extends Model
{
    use HasFactory;

    protected $table = "user_like_posts";

    protected $fillable = [
        'id',
        'post_id',
        'user_id'
    ];
}
