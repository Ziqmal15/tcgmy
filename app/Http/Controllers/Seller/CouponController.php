<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::where('approved_by', Auth::user()->id)
            ->latest()
            ->get();

        return view('pages.seller.coupon.index', compact('coupons'));
    }

    public function create()
    {

        return view('pages.seller.coupon.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCoupon($request);
        $validated['approved_by'] = Auth::user()->id;
        $validated['created_by'] = Auth::user()->id;
        if (empty($validated['code'])) {
            $validated['code'] = $this->generateUniqueCode();
        }

        Coupon::create($validated);
        
        return redirect()
            ->route('seller.coupons.index')
            ->with('success', 'Voucher created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $this->authorize('update', $coupon);
        return view('pages.seller.coupon.create', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $this->authorize('update', $coupon);
        $validated = $this->validateCoupon($request);
        
        $coupon->update($validated);

        return redirect()
            ->route('seller.coupons.index')
            ->with('success', 'Voucher updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $this->authorize('delete', $coupon);
        
        if ($coupon->isUsedInOrder()) {
            return back()->with('error', 'Cannot delete voucher as it has been used in orders.');
        }

        $coupon->delete();

        return redirect()
            ->route('seller.coupons.index')
            ->with('success', 'Voucher deleted successfully.');
    }

    public function showAssignForm(Coupon $coupon)
    {
        $this->authorize('update', $coupon);
        $users = User::where('role', 'user')->get();
        return view('pages.seller.coupon.assign', compact('coupon', 'users'));
    }

    public function assignToUser(Request $request, Coupon $coupon)
    {
        $this->authorize('update', $coupon);
        
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        foreach ($validated['user_ids'] as $userId) {
            // Check if user already has this coupon
            $exists = UserCoupon::where('user_id', $userId)
                ->where('coupon_id', $coupon->id)
                ->exists();
            
            if (!$exists) {
                UserCoupon::create([
                    'user_id' => $userId,
                    'coupon_id' => $coupon->id,
                    'is_used' => false
                ]);
            }
        }

        return redirect()
            ->route('seller.coupons.index')
            ->with('success', 'Coupon assigned to selected users successfully.');
    }

    protected function validateCoupon(Request $request)
    {
        return $request->validate([
            'code' => 'nullable|string|max:50|unique:coupons,code,' . ($request->coupon->id ?? ''),
            'type' => 'required|in:product,shipping',
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'min_spend' => 'required|numeric|min:0',
            'auto_assign_threshold' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'is_active' => 'boolean',
        ]);
    }
}
