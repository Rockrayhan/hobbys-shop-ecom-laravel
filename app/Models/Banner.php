<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'is_active',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
