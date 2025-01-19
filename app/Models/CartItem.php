<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card;

class CartItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cart_id',
        'card_id',
        'quantity',
        'price',
        'status'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class, 'cartItem_id');
    }
}
