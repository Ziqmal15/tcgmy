<?php

use App\Models\Order;
use App\Models\Salesreport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    public function generateReport()
    {
        // Get total sales and total orders for a specific date (you can adjust the date dynamically)
        $date = now()->toDateString();  // Get today's date, you can adjust for other dates
        
        $salesData = DB::table('orders')
            ->select(
                DB::raw('COUNT(id) as total_orders'),
                DB::raw('SUM(order_amount) as total_sales')
            )
            ->where('order_status', 'Completed')
            ->whereDate('order_date', $date) // You can change this to filter by other criteria (month, year, etc.)
            ->first();  // Get the first result since it's aggregated

        // If there is any sales data (i.e., at least one completed order)
        if ($salesData) {
            // Create the sales report entry in the sales_report table
            Salesreport::create([
                'date' => $date,               // Date of the report (can be dynamic)
                'total_sales' => $salesData->total_sales, // Total sales
                'order_id' => $salesData->total_orders,  // Total orders count
            ]);
        }

        // Optionally return a response or view
        return response()->json([
            'message' => 'Sales report generated successfully.',
            'data' => $salesData
        ]);
    }
}

