<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkout_id',
        'proof_of_payment',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
