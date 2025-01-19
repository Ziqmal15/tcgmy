<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    //
    protected $table = 'user_coupons';

    protected $fillable = [
        'user_id',
        'coupon_id',
        'is_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
