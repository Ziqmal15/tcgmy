<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->withCount('orderItems')
            ->latest()
            ->paginate(10);

        return view('pages.seller.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user', 'orderItems'])->findOrFail($id);
        return view('pages.seller.order.show', compact('order'));
    }

    /**
     * Cancel/Remove the specified order.
     */
    public function destroy(string $id)
    {
        try {
            $order = Order::findOrFail($id);
            
            if ($order->status === 'approved') {
                return redirect()->route('seller.order.index')
                    ->with('error', 'Cannot cancel an approved order');
            }
            
            $order->update(['status' => 'cancelled']);
            
            return redirect()->route('seller.order.index')
                ->with('success', 'Order cancelled successfully');
        } catch (\Exception $e) {
            return redirect()->route('seller.order.index')
                ->with('error', 'Failed to cancel order');
        }
    }

    /**
     * Approve the specified order.
     */
    public function approve(string $id)
    {
        try {
            $order = Order::findOrFail($id);
            
            if ($order->status === 'cancelled') {
                return redirect()->route('seller.order.index')
                    ->with('error', 'Cannot approve a cancelled order');
            }
            
            $order->update(['status' => 'approved']);
            
            return redirect()->route('seller.order.index')
                ->with('success', 'Order approved successfully');
        } catch (\Exception $e) {
            return redirect()->route('seller.order.index')
                ->with('error', 'Failed to approve order');
        }
    }

    /**
     * Update tracking number for an order
     */
    public function updateTracking(Request $request, string $id)
    {
        try {
            $order = Order::findOrFail($id);
            if ($order->status === 'pending') {
                return redirect()->back()
                    ->with('error', 'Cannot add tracking number for a pending order');
            }
            
            if ($order->status === 'cancelled') {
                return redirect()->back()
                    ->with('error', 'Cannot add tracking number for a cancelled order');
            }
            if ($order->status !== 'approved') {
                return redirect()->back()
                    ->with('error', 'Cannot add tracking number before receipt approval');
            }

            $request->validate([
                'tracking_number' => 'required|string|max:255'
            ]);
            
            $order->update([
                'tracking_number' => $request->tracking_number,
                'status' => 'shipped'
            ]);
            
            return redirect()->back()
                ->with('success', 'Tracking number updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update tracking number');
        }
    }
    
}
