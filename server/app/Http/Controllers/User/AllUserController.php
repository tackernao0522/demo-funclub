<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\User;
use PDF;

class AllUserController extends Controller
{
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')->get();

        return view('user.order.order_view', compact('orders'));
    }

    public function orderDetails($order_id)
    {
        $order = Order::with('division', 'district', 'user')
            ->where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $orderItems = OrderItem::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.order.order_details', compact('order', 'orderItems'));
    }

    public function invoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $orderItems = OrderItem::with('product')->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        $pdf = PDF::loadView('user.order.order_invoice',  compact(
            'order',
            'orderItems',
        ))->setPaper('a4');

        return $pdf->download('invoice.pdf');
    }

    public function returnOrder(Request $request, $order_id)
    {
        $validatedData = $request->validate([
            'return_product_name' => 'required',
            'return_product_no' => 'required',
            'return_reason' => 'required',
        ], [
            'return_product_name.required' => '商品名を入力してください。',
            'return_product_no.required' => '商品番号を入力してください。',
            'return_reason.required' => '返品理由を記入してください。',
        ]);

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('Y年n月j日'),
            'return_product_name' => $request->return_product_name,
            'return_product_no' => $request->return_product_no,
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => '返品手続きが完了しました。',
            'alert-type' => 'success',
        );

        return redirect()->route('my.orders')
            ->with($notification);
    }

    public function returnOrderList()
    {
        $orders = Order::where('user_id', Auth::id())
            ->where('return_reason', '!=', NULL)
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.order.return_order_view', compact('orders'));
    }

    public function cancelOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->where('status', 'キャンセル')
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.order.cancel_order_view', compact('orders'));
    }

    public function orderTracking(Request $request)
    {
        $invoice = $request->code;

        $track = Order::where('invoice_no', $invoice)->first();

        if ($track) {
            // echo "<pre>";
            // print_r($track);

            return view('shop.tracking.track_order', compact('track'));
        } else {
            $notification = array(
                'message' => 'この請求番号は見当たりません。',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    public function privacyPolicy()
    {
        return view('shop.body.privacy_policy');
    }
}
