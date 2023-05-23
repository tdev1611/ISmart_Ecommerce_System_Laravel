<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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

    function  dashboard()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(50);
        //  SELECT * FROM `orders` GROUP BY `status` = 2
        $counts = Order::select('status', Order::raw('COUNT(*) as total'))
            ->whereIn('status', [1, 2, 3, 4])
            ->groupBy('status')
            ->get();
        // foreach ($counts as $count) {
        //     if ($count->status == 1) {
        //         $waiting_progressing = $count->total;
        //     } elseif ($count->status == 2) {
        //         $Processing = $count->total;
        //     } else {
        //         $success = $count->total;
        //     }
        // }
        //  Tổng tất cả đơn hàng
           //  $total_sum = Order::sum('totalCart');
           
        $total_sum_success = Order::selectRaw('SUM(REPLACE(totalCart, ".", "")) as total')->where('status',3)->first()->total;
        $total_sum_success = number_format($total_sum_success, 0, '', '.') . ' VND';
        //    'waiting_progressing','Processing','success',
        $count_trash = Order::onlyTrashed()->count(); 

        return view('admin.dashboard', compact('orders', 'counts', 'total_sum_success','count_trash'));
    }
}
