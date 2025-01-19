<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'total',
        'status',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
