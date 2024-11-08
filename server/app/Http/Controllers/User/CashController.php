<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CashController extends Controller
{
    public function cashOrder(Request $request)
    {
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $products = Product::where('id', $cart->id)->get();
            foreach ($products as $product) {
                if ($product->product_qty <= 0) {
                    $notification = array(
                        'message' => $product->product_name . 'は売り切れです。',
                        'alert-type' => 'error'
                    );

                    return redirect()->route('shop.index')->with($notification);
                }
            }
        }

        if (Cart::total() <= 0) {
            $notification = array(
                'message' => 'カートに商品は入っていません。',
                'alert-type' => 'error'
            );

            return redirect()->route('shop.index')->with($notification);
        }

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = floor((int) Cart::total());
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => '代引き配送',
            'payment_method' => '代引き配送',
            'currency' => 'JPY',
            'amount' => $total_amount,
            'invoice_no' => 'FUN' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('Y年n月j日'),
            'order_month' => Carbon::now()->format('n月'),
            'order_year' => Carbon::now()->format('Y年'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));
        // End Send Email(php artisan make:mail OrderMail)

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $products = OrderItem::where('order_id', $order_id)->get();
        foreach ($products as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
        }

        $notification = array(
            'message' => 'ご注文が完了しました。',
            'alert-type' => 'success',
        );

        return redirect()->route('user.dashboard')
            ->with($notification);
    }
}
