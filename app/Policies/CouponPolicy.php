<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the coupon.
     */
    public function update(User $user, Coupon $coupon): bool
    {
        return $user->id === $coupon->approved_by;
    }

    /**
     * Determine whether the user can delete the coupon.
     */
    public function delete(User $user, Coupon $coupon): bool
    {
        return $user->id === $coupon->approved_by;
    }
    
} 