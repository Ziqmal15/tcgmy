<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'cartItem_id',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class, 'cartItem_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
} 
