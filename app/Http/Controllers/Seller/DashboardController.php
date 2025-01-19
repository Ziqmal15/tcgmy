<?php

namespace App\Http\Controllers\Seller;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\User;
use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total sales (from completed orders)
        $totalSales = Order::where('status', 'completed')
            ->sum('total');

        // Get total orders
        $totalOrders = Order::count();

        // Get total products (cards)
        $totalProducts = Card::count();

        // Get total customers (users who have placed orders)
        $totalCustomers = Order::distinct('user_id')->count('user_id');

        // Get best-selling products
        $bestSellingProducts = DB::table('order_items')
            ->join('cart_items', 'order_items.cartItem_id', '=', 'cart_items.id')
            ->join('cards', 'cart_items.card_id', '=', 'cards.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select('cards.*', DB::raw('COUNT(order_items.id) as total_sales'))
            ->groupBy('cards.id', 'cards.card_name', 'cards.price', 'cards.series', 
                     'cards.rarity', 'cards.description', 'cards.image', 
                     'cards.set_code', 'cards.stock', 'cards.created_at', 
                     'cards.updated_at')
            ->orderBy('total_sales', 'desc')
            ->take(6)
            ->get();

        // Get recent products
        $recentProducts = Card::latest()
            ->take(6)
            ->get();

        // Get monthly sales data for the chart
        $monthlySales = collect();
        $monthLabels = collect();
        
        // Get last 6 months of sales data
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels->push($date->format('M'));
            
            $sales = Order::where('status', 'completed')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total');
                
            $monthlySales->push($sales);
        }

        // Get feedbacks
        $feedbacks = DB::table('feedbacks')
            ->join('users', 'feedbacks.user_id', '=', 'users.id')
            ->select('feedbacks.*', 'users.name')
            ->orderBy('feedbacks.created_at', 'desc')
            ->get();

        return view('pages.seller.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'recentProducts',
            'monthLabels',
            'monthlySales',
            'bestSellingProducts',
            'feedbacks'
        ));
    }
}
