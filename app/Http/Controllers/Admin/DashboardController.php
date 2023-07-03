<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product_view;

class DashboardController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'dashboard']);
            return $next($request);
        });
    }

    // index dashborad

    function dashboard()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        //  SELECT * FROM `orders` GROUP BY `status` = 2
        $counts = Order::select('status', Order::raw('COUNT(*) as total'))
            ->whereIn('status', [1, 2, 3, 4])
            ->groupBy('status')
            ->get();
        $total_sum_success = Order::selectRaw('SUM(REPLACE(totalCart, ".", "")) as total')->where('status', 3)->first()->total;
        $total_sum_success = number_format($total_sum_success, 0, '', '.') . ' VND';
        //    'waiting_progressing','Processing','success',
        $count_trash = Order::onlyTrashed()->count();


        // prodct_view

        $product_views = Product_view::orderBy('view_count','desc')->get();


        return view('admin.dashboard', compact('orders', 'counts', 'total_sum_success', 'count_trash','product_views'));
    }
}