<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnOrderMethod;
use App\Models\Order;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function returnRequest()
    {
        if (auth()->user()->returnorder == 1) {
            $returnOrderProductMethods = ReturnOrderMethod::orderBy('sort_no', 'ASC')->get();
            $orders = Order::where('return_order', 1)->orderBy('id', 'ASC')->get();

            return view('admin.shop.return_order.return_request', compact('orders', 'returnOrderProductMethods'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function returnMethod(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validatedData = $request->validate([
            'return_order_method_name_id' => 'required',
        ], [
            'return_order_method_name_id.required' => '対応方法を選択してください。',
        ]);

        $order->return_order_method_name_id = $request->return_order_method_name_id;
        $order->save();

        $notification = array(
            'message' => '対応方法を選択しました。',
            'alert-type' => 'info',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function refundAmount(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validatedData = $request->validate([
            'refund_amount' => 'required|integer',
        ], [
            'refund_amount.required' => '返金額は必須です。',
            'refund_amount.integer' => '返金額には整数を入力してください。',
        ]);

        $order->refund_amount = $request->refund_amount;
        $order->save();

        $notification = array(
            'message' => '返金額を決定しました。',
            'alert-type' => 'info',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function returnRequestApprove($order_id)
    {
        if (auth()->user()->returnorder == 1) {
            Order::where('id', $order_id)->update(['return_order' => 2]);

            $notification = array(
                'message' => '返品手続きを承認しました。',
                'alert-type' => 'success',
            );

            return redirect()->back()
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

    public function returnAllRequest()
    {
        if (auth()->user()->returnorder == 1) {
            $orders = Order::where('return_order', 2)->orderBy('id', 'ASC')->get();

            return view('admin.shop.return_order.all_return_request', compact('orders'));
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
