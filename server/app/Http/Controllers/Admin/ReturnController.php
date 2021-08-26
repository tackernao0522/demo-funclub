<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function returnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();

        return view('admin.shop.return_order.return_request', compact('orders'));
    }

    public function returnRequestApprove($order_id)
    {
        Order::where('id', $order_id)->update(['return_order' => 2]);

        $notification = array(
            'message' => '返品手続きを承認しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function returnAllRequest()
    {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();

        return view('admin.shop.return_order.all_return_request', compact('orders'));
    }
}
