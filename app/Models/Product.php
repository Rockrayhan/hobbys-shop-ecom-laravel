<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

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


    protected $dates = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
