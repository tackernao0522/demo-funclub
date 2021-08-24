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
}
