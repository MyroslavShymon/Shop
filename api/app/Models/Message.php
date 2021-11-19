<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";

    protected $fillable = [
        'id',
        'from_user_id',
        'to_user_id',
        'text'
    ];
}
