<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model
{
    use HasFactory;
    protected $table = "comment_products";

    protected $fillable = [
        'id',
        'text',
        'user_id',
        'product_id',
    ];
}
