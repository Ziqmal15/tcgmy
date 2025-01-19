<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
        'seller_id',
        'card_name',
        'series',
        'rarity',
        'description',
        'set_code',
    ];

    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function ratingNReview()
    {
        return $this->hasMany(RatingNReview::class);
    }
}
