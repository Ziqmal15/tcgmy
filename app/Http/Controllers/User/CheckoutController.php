<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\CartItem;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        return redirect()->route('user.order.index');
    }

    /**
     * Show the checkout form for a specific order.
     */
    public function create(string $id)
    {
        $order = Order::with(['orderItems.cartItem.card'])->findOrFail($id);
        
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('user.order.index')
                ->with('error', 'You are not authorized to access this order.');
        }

        // Check if order is in the correct state for checkout
        if ($order->status !== 'pending') {
            return redirect()->route('user.order.index')
                ->with('error', 'This order cannot be processed for checkout.');
        }

        $orderItems = $order->orderItems;
        $user = Auth::user();
        $availableCoupons = $this->getAvailableCoupons($user, $order);

        return view('pages.user.checkout', compact('orderItems', 'order', 'availableCoupons'));
    }

    /**
     * Process the checkout and store payment information.
     */
    public function store(Request $request, string $id)
    {
        // Basic validation
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'total' => 'required|numeric|min:0',
        ], [
            'proof_of_payment.required' => 'Please upload your proof of payment.',
            'proof_of_payment.image' => 'The uploaded file must be an image.',
            'proof_of_payment.mimes' => 'Please upload a valid image file (JPEG, PNG, GIF).',
            'proof_of_payment.max' => 'The image size must not exceed 10MB.',
            'total.required' => 'The total amount is required.',
            'total.numeric' => 'The total amount must be a number.',
            'total.min' => 'The total amount must be greater than 0.',
        ]);

        try {
            $order = Order::findOrFail($id);

            // Security checks
            if ($order->user_id !== Auth::id()) {
                return redirect()->route('user.order.index')
                    ->with('error', 'You are not authorized to process this order.');
            }

            if ($order->status !== 'pending') {
                return redirect()->route('user.order.index')
                    ->with('error', 'This order cannot be processed for payment.');
            }

            if (abs($order->total - $request->total) > 0.01) {
                return redirect()->back()
                    ->with('error', 'Order total amount mismatch. Please try again.');
            }

            // Handle file upload
            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment');
                
                // Generate unique filename
                $filename = 'payment_' . time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
                
                // Move file to storage
                $path = $file->storeAs('proof_of_payment', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to upload payment proof.');
                }

                // Create checkout record
                $checkout = Checkout::create([
                    'order_id' => $order->id,
                    'total' => $request->total,
                ]);

                // Create payment record
                Payment::create([
                    'checkout_id' => $checkout->id,
                    'proof_of_payment' => $path,
                    'status' => 'pending',
                ]);

                // Update order status
                $order->update(['status' => 'pending']);

                return redirect()->route('user.order.show', $order->id)
                    ->with('success', 'Your order has been placed successfully! We will process your payment shortly.');
            }

            return redirect()->back()
                ->with('error', 'No payment proof was uploaded. Please try again.');

        } catch (\Exception $e) {
            // Log error for debugging
            logger()->error('Checkout Error: ' . $e->getMessage());

            // Clean up uploaded file if it exists
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while processing your order. Please try again.')
                ->withInput();
        }
    }

    /**
     * Get available coupons for the user and order.
     */
    private function getAvailableCoupons($user, $order)
    {
        $coupons = collect();

        // Registration coupon (for first-time users)
        if ($user->orders()->count() === 1) {
            $registrationCoupon = Coupon::where('type', 'registration')
                ->where('is_active', true)
                ->whereDate('valid_until', '>=', now())
                ->first();
            if ($registrationCoupon) {
                $coupons->push($registrationCoupon);
            }
        }

        // Birthday coupon (if it's user's birthday month)
        if ($user->profile && $user->profile->birth_date) {
            $birthMonth = Carbon::parse($user->profile->birth_date)->format('m');
            $currentMonth = now()->format('m');
            
            if ($birthMonth === $currentMonth) {
                $birthdayCoupon = Coupon::where('type', 'birthday')
                    ->where('is_active', true)
                    ->whereDate('valid_until', '>=', now())
                    ->first();
                if ($birthdayCoupon) {
                    $coupons->push($birthdayCoupon);
                }
            }
        }

        // General discount coupons
        $discountCoupons = Coupon::where('type', 'discount')
            ->where('is_active', true)
            ->whereDate('valid_until', '>=', now())
            ->whereNotNull('approved_by')
            ->get();
        
        return $coupons->concat($discountCoupons);
    }
}
