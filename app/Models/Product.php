<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'description',
        'current_price',
        'previous_price',
        'isOnSale'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
