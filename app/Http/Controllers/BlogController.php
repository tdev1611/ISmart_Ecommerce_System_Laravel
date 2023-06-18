<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Order;
class BlogController extends Controller
{
    //

    function blogShows(){

      
         $posts = Post::paginate(5);
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
 
        return view('Posts.index',compact('posts','bestSellingProducts'));
    }



    function detailBlog($slug) {
        $post = Post::where('slug', $slug)->first();

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
        return view('Posts.detail',compact('post','bestSellingProducts'));
    }
}
