<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function districtGetAjax($division_id)
    {
        $ships = ShipDistrict::where('division_id', $division_id)
            ->orderBy('id', 'ASC')
            ->get();

        return json_encode($ships);
    }

    public function checkoutStore(Request $request)
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
        } else {
            // dd($request->all());
            $data = array();
            $data['shipping_name'] = $request->shipping_name;
            $data['shipping_email'] = $request->shipping_email;
            $data['shipping_phone'] = $request->shipping_phone;
            $data['post_code'] = $request->post_code;
            $data['division_id'] = $request->division_id;
            $data['district_id'] = $request->district_id;
            $data['notes'] = $request->notes;
            $cartTotal = Cart::total();

            if ($request->payment_method == 'card') {

                return view('shop.payment.stripe', compact('data', 'cartTotal'));
            } else {

                return view('shop.payment.cash', compact('data', 'cartTotal'));
            }
        }
    }
}
