<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;

    protected $table = "post";
//    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'description',
        'likes',
        'views',
        'image',
        'post_date',
        'category_id',
        'user_id'
    ];
}
