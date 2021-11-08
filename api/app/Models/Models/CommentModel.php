<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = "comment";
//    public $timestamps = false;

    protected $fillable = [
        'id',
        'text',
        'user_id',
        'post_date',
        'post_id',
        'likes',
    ];
}
