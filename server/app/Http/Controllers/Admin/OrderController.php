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
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'pending')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.pending_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function pendingOrdersDetails($order_id)
    {
        if (auth()->user()->orders == 1) {
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
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function confirmedOrders()
    {
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'confirm')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.confirmed_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function processingOrders()
    {
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'processing')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.processing_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function pickedOrders()
    {
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'picked')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.picked_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function shippedOrders()
    {
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'shipped')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.shipped_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function deliveredOrders()
    {
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'delivered')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.delivered_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function cancelOrders()
    {
        if (auth()->user()->orders == 1) {
            $orders = Order::where('status', 'cancel')
                ->orderBy('id', 'DESC')
                ->get();

            return view('admin.shop.orders.cancel_orders', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function pendingToConfirm($order_id)
    {
        if (auth()->user()->orders == 1) {
            Order::findOrFail($order_id)->update([
                'status' => 'confirm',
                'confirmed_date' => Carbon::now()->format('Y年n月j日'),
            ]);

            $notification = array(
                'message' => '確認済にしました。',
                'alert-type' => 'success',
            );

            return redirect()->route('pending-orders')
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function confirmToProcessing($order_id)
    {
        if (auth()->user()->orders == 1) {
            Order::findOrFail($order_id)->update([
                'status' => 'processing',
                'processing_date' => Carbon::now()->format('Y年n月j日'),
            ]);

            $notification = array(
                'message' => '対応中にしました。',
                'alert-type' => 'success',
            );

            return redirect()->route('confirmed-orders')
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function processingToPicked($order_id)
    {
        if (auth()->user()->orders == 1) {
            Order::findOrFail($order_id)->update([
                'status' => 'picked',
                'picked_date' => Carbon::now()->format('Y年n月j日'),
            ]);

            $notification = array(
                'message' => '発送可能にしました。',
                'alert-type' => 'success',
            );

            return redirect()->route('processing-orders')
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function pickedToShipped($order_id)
    {
        if (auth()->user()->orders == 1) {
            Order::findOrFail($order_id)->update([
                'status' => 'shipped',
                'shipped_date' => Carbon::now()->format('Y年n月j日'),
            ]);

            $notification = array(
                'message' => '発送済にしました。',
                'alert-type' => 'success',
            );

            return redirect()->route('picked-orders')
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function shippedToDelivered($order_id)
    {
        if (auth()->user()->orders == 1) {
            $products = OrderItem::where('order_id', $order_id)->get();
            foreach ($products as $item) {
                Product::where('id', $item->product_id)
                    ->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
            }

            Order::findOrFail($order_id)->update([
                'status' => 'delivered',
                'delivered_date' => Carbon::now()->format('Y年n月j日'),
            ]);

            $notification = array(
                'message' => '配達完了にしました。',
                'alert-type' => 'success',
            );

            return redirect()->route('shipped-orders')
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function adminInvoiceDownload($order_id)
    {
        if (auth()->user()->orders == 1) {
            $order = Order::with('division', 'district', 'user')->where('id', $order_id)->first();

            $orderItems = OrderItem::with('product')->where('order_id', $order_id)
                ->orderBy('id', 'DESC')
                ->get();

            $pdf = PDF::loadView('admin.shop.orders.order_invoice',  compact(
                'order',
                'orderItems',
            ))->setPaper('a4');

            return $pdf->download('invoice.pdf');
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }
}
