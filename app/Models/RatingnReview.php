<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingNReview extends Model
{
    protected $table = 'ratingnreviews';

    protected $fillable = [
        'user_id', 
        'card_id', 
        'rating', 
        'review'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Card()
    {
        return $this->belongsTo(Card::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
