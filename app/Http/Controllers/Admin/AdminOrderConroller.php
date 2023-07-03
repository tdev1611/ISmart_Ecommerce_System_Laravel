<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class AdminOrderConroller extends Controller
{
    //
    function __construct()
    {
        // class active sidebar
        $this->middleware(function ($request, $next) {
            session(['modules_active' => 'orders']);
            return $next($request);
        });
    }


    function index(Request $request)
    {
        $key = request()->key;
        $status = $request->status;
        $orders = Order::orderBy('created_at', 'DESC')->where('code', 'like', '%' . $key . '%')
            ->orWhere('fullname', 'like', '%' . $key . '%')
            ->orWhere('phone', 'like', '%' . $key . '%')
            ->paginate(20);
        // success processing waitprocessing cancel : 3-2-1-4
        if ($status == 'success') {
            $orders = Order::where('status', 3)->Where('code', 'like', '%' . $key . '%')
                // ->Where('fullname', 'like', '%' . $key . '%')
                // ->Where('phone', 'like', '%' . $key . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        } elseif ($status == 'processing') {
            $orders = Order::where('status', 2)->Where('code', 'like', '%' . $key . '%')
                // ->Where('fullname', 'like', '%' . $key . '%')
                // ->Where('phone', 'like', '%' . $key . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        } elseif ($status == 'waitprocessing') {
            $orders = Order::where('status', 1)->Where('code', 'like', '%' . $key . '%')
                // ->Where('fullname', 'like', '%' . $key . '%')
                // ->Where('phone', 'like', '%' . $key . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        } elseif ($status == 'cancel') {
            $orders = Order::where('status', 4)->Where('code', 'like', '%' . $key . '%')
                // ->Where('fullname', 'like', '%' . $key . '%')
                // ->Where('phone', 'like', '%' . $key . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
            // thùng rác
        } elseif ($status == 'trash') {
            $orders = Order::onlyTrashed()->where('code', 'like', '%' . $key . '%')
                // ->where('fullname', 'like', '%' . $key . '%')
                // ->where('phone', 'like', '%' . $key . '%')
                ->orderByDesc('created_at')
                ->paginate(20);    // data ở softdelete
        }

        $counts = Order::select('status', Order::raw('COUNT(*) as total'))  // coun per_status
            ->whereIn('status', [1, 2, 3, 4])
            ->groupBy('status')
            ->get();
        $total_Count = Order::count();
        $count_trash = Order::onlyTrashed()->count();
        return view('admin.Orders.list-order', compact('orders', 'counts', 'total_Count', 'count_trash'));
    }

    // detail 
    function detail($id)
    {
         $order = Order::find($id);
          
        return view('admin.Orders.detail-order', compact('order'));
    }

    //delete 
    function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect(route('admin.listOrder'))->with('success', 'Xóa đơn hàng thành công');
    }

    // restore forceDelelte
    function restore($id)
    {
        $order = Order::withTrashed()->find($id);
        $order->restore();
        return redirect()->back()->with('success', 'Khôi phục đơn hàng thành công');
    }

    function forceDelelte($id)
    {
        $order = Order::withTrashed()->find($id);
        $order->forceDelete();
        return redirect()->with('success', 'Xóa vĩnh viễn thành công');
    }


    // action  : delete all , restore all
    // function action(Request $request)
    // {
    //     $list_checks = $request->list_check;   // chỉ đến name của input
    //     if ($list_checks) {
    //         if (!empty($list_checks)) {
    //             $action = $request->action;
    //             if ($action == 'delete') {
    //                 Order::whereIn('id', $list_checks)->delete();
    //                 return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
    //             } elseif ($action == 'restore') {
    //                 Order::withTrashed()->whereIn('id', $list_checks)->restore();
    //                 return redirect()->back()->with('success', 'Khôi phục đơn hàng thành công');
    //             } elseif ($action == 'forceDelelte') {
    //                 Order::withTrashed()->whereIn('id', $list_checks)->forceDelete();
    //                 return redirect()->back()->with('success', 'Xóa vĩnh viễn đơn hàng thành công');
    //             }
    //         }
    //         return redirect()->back()->with('warning', 'Vui lòng chọn chức năng');
    //     } else {
    //         return redirect()->back()->with('warning', 'Vui lòng chọn bản ghi');
    //     }
     
    // }

    function action(Request $request)
    {
        $list_checks = $request->list_check;
        $action = $request->action;
        if (empty($list_checks)) {
            return redirect()->back()->with('warning', 'Vui lòng chọn bản ghi');
        }
        if (empty($action)) {
            return redirect()->back()->with('warning', 'Vui lòng chọn chức năng');
        }
        $successMessage = '';
        switch ($action) {
            case 'delete':
                Order::whereIn('id', $list_checks)->delete();
                $successMessage = 'Xóa đơn hàng thành công';
                break;
            case 'restore':
                Order::withTrashed()->whereIn('id', $list_checks)->restore();
                $successMessage = 'Khôi phục đơn hàng thành công!';
                break;
            case 'forceDelelte':
                Order::withTrashed()->whereIn('id', $list_checks)->forceDelete();
                $successMessage = 'Xóa đơn hàng vĩnh viễn thành công!';
                break;
        }

        return redirect()->back()->with('success', $successMessage);

    }


    // update trang thái đơn hàng
    function update_status(Request $request, $id)
    {
        $status = $request->only('status');
        Order::find($id)->update($status);
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
        // return redirect('admin/dashboard')->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
}
