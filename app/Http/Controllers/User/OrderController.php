<?php

namespace App\Http\Controllers\User;

use id;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CouponController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:cart_items,id'
        ]);

        // Create new order
        $ordername = Auth::user()->name . '-' . date('Y-m-d H:i:s');
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'name' => $ordername,
        ]);

        // Get selected cart items
        $cartItems = CartItem::whereIn('id', $request->items)->get();

        // Create order items from selected cart items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'cartItem_id' => $cartItem->id,
            ]);

            // Optionally remove items from cart after order creation
            $cartItem->update(['status' => 'ordered']);
        }

        return redirect()->route('user.checkout.create', $order->id)->with('success', 'Checkout successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('pages.user.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function cancel(Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::user()->id) {
            abort(403);
        }

        // Delete order items
        $order->orderItems()->delete();
        
        // Delete the order
        $order->delete();

        return redirect()->route('user.cart.index')->with('success', 'Order has been cancelled successfully');
    }

    public function markAsReceived(Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::user()->id) {
            abort(403);
        }

        // Check if the order is in shipped status
        if ($order->status !== 'shipped') {
            return back()->with('error', 'Only shipped orders can be marked as received.');
        }

        // Update the order status to completed
        $order->update(['status' => 'completed']);

        // Auto-assign coupons based on order total
        app(CouponController::class)->autoAssignCoupons($order->user_id, $order->total);

        return back()->with('success', 'Order has been marked as received.');
    }
}
