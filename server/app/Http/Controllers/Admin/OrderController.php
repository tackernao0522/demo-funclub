<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', 'pending')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.pending_orders', compact('orders'));
    }

    public function pendingOrdersDetails($order_id)
    {
        $order = Order::with('division', 'district', 'user')
            ->where('id', $order_id)
            ->first();

        $orderItems = OrderItem::with('product')->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.pending_orders_details', compact(
            'order',
            'orderItems',
        ));
    }

    public function confirmedOrders()
    {
        $orders = Order::where('status', 'confirm')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.confirmed_orders', compact('orders'));
    }

    public function processingOrders()
    {
        $orders = Order::where('status', 'processing')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.processing_orders', compact('orders'));
    }

    public function pickedOrders()
    {
        $orders = Order::where('status', 'picked')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.picked_orders', compact('orders'));
    }

    public function shippedOrders()
    {
        $orders = Order::where('status', 'shipped')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.shipped_orders', compact('orders'));
    }

    public function deliveredOrders()
    {
        $orders = Order::where('status', 'delivered')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.delivered_orders', compact('orders'));
    }

    public function cancelOrders()
    {
        $orders = Order::where('status', 'cancel')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.shop.orders.cancel_orders', compact('orders'));
    }
}
