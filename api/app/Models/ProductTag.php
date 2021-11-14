<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $table = "product_tags";

    protected $fillable = [
        'id',
        'product_id',
        'tag_id',
    ];
}
