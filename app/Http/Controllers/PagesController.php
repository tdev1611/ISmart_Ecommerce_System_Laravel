<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
{
    //

    function index()
    {
        $pages = Page::where('status', 1)->get();

         $bestSellingProducts = Order::select('order_detail')
            ->whereNotNull('order_detail')
            ->get()
            ->flatMap(function ($order) {
                return json_decode($order->order_detail, true);
            })
            ->groupBy('id')
            ->map(function ($orders) {
                return [
                    'product_id' => $orders[0]['id'],
                    'name' => $orders[0]['name'],
                    'price' => $orders[0]['price'],
                    'slug' => $orders[0]['options']['slug'],
                    'images' => $orders[0]['options']['images'],
                    'total_sold' => collect($orders)->sum('qty'),
                ];
            })
            ->sortByDesc('total_sold')
            ->take(6)
            ->values();
        return view('Pages.index', compact('pages','bestSellingProducts'));
    }
}
