<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function apply(Coupon $coupon, Request $request)
    {

        try {
            Log::info('Applying coupon', [
                'coupon_id' => $coupon->id,
                'order_id' => $request->order_id
            ]);

            $order = Order::findOrFail($request->order_id);
            
            // Check if coupon is valid
            if (!$coupon->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon has already been used or is no longer valid'
                ]);
            }

            // Calculate order total
            $total = $order->orderItems->sum(function($item) {
                return $item->cartItem->price * $item->cartItem->quantity;
            });

            Log::info('Order details', [
                'total' => $total,
                'min_spend' => $coupon->min_spend,
                'valid_until' => $coupon->valid_until
            ]);

            // Validate minimum spend
            if ($total < $coupon->min_spend) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order total does not meet minimum spend requirement'
                ]);
            }

            // Apply coupon to order
            $order->coupon_id = $coupon->id;
            $order->discount = $coupon->calculateDiscount($total);
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully',
                'new_total' => $order->getDiscountedTotal()
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to apply coupon', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to apply coupon: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeCoupon(Order $order)
    {
        try {
            $order->coupon_id = null;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Coupon removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove coupon'
            ]);
        }
    }

    public function index()
    {
        $user = Auth::user();
        
        // Check for orders that qualify for auto-assign coupons
        $this->checkAndAssignMissedCoupons($user->id);

        // Get user's available coupons
        $userCoupons = UserCoupon::where('is_used', false)
            ->where('user_id', $user->id)
            ->get();

        // Get potential auto-assign coupons that user doesn't have yet
        $potentialCoupons = Coupon::where('is_active', true)
            ->where('valid_until', '>', now())
            ->whereNotNull('auto_assign_threshold')
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('auto_assign_threshold', 'asc')
            ->get();

        return view('pages.user.coupon', compact('userCoupons', 'potentialCoupons'));
    }

    /**
     * Check for completed orders that meet auto-assign thresholds but haven't received coupons
     */
    protected function checkAndAssignMissedCoupons($userId)
    {
        try {
            // Get all completed orders
            $completedOrders = Order::where('user_id', $userId)
                ->where('status', 'completed')
                ->get();

            // Get all auto-assign coupons
            $autoAssignCoupons = Coupon::where('is_active', true)
                ->where('valid_until', '>', now())
                ->whereNotNull('auto_assign_threshold')
                ->get();

            foreach ($completedOrders as $order) {
                foreach ($autoAssignCoupons as $coupon) {
                    // Check if order meets threshold and user doesn't have this coupon
                    if ($order->total >= $coupon->auto_assign_threshold) {
                        $exists = UserCoupon::where('user_id', $userId)
                            ->where('coupon_id', $coupon->id)
                            ->exists();
                        
                        if (!$exists) {
                            // Create user coupon
                            UserCoupon::create([
                                'user_id' => $userId,
                                'coupon_id' => $coupon->id,
                                'is_used' => false
                            ]);

                            // Decrease coupon quantity
                            $coupon->decrement('quantity');

                            Log::info('Auto-assigned missed coupon', [
                                'user_id' => $userId,
                                'order_total' => $order->total,
                                'coupon_id' => $coupon->id,
                                'order_id' => $order->id
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to check and assign missed coupons', [
                'error' => $e->getMessage(),
                'user_id' => $userId,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function autoAssignCoupons($userId, $orderTotal)
    {
        try {
            // Find all eligible coupons based on auto_assign_threshold
            $eligibleCoupons = Coupon::where('auto_assign_threshold', '<=', $orderTotal)
                ->where('is_active', true)
                ->where('valid_until', '>', now())
                ->whereDoesntHave('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->orderBy('discount_amount', 'desc')
                ->get();

            foreach ($eligibleCoupons as $coupon) {
                // Create user coupon
                UserCoupon::create([
                    'user_id' => $userId,
                    'coupon_id' => $coupon->id,
                    'is_used' => false
                ]);

                // Decrease coupon quantity
                $coupon->decrement('quantity');

                Log::info('Auto-assigned coupon', [
                    'user_id' => $userId,
                    'order_total' => $orderTotal,
                    'coupon_id' => $coupon->id,
                    'discount_amount' => $coupon->discount_amount
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to auto-assign coupon', [
                'error' => $e->getMessage(),
                'user_id' => $userId,
                'order_total' => $orderTotal,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
} 