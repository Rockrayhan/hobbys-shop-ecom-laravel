<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_name',
        'phone',
        'address',
        'is_inside_dhaka',
        'delivery_charge',
        'subtotal',
        'grand_total',
        'order_status',
    ];

    protected $casts = [
        'is_inside_dhaka' => 'boolean',
        'delivery_charge' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
