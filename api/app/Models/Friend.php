<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    protected $table = "friends";

    protected $fillable = [
        'id',
        'user_id_1',
        'user_id_2',
    ];
}
