<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'category_id',
        'product_name',
        'product_photo',
        'product_price',
        'product_description',
        'is_active'
    ];
}
