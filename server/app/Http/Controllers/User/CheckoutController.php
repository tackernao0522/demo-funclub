<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;

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

        if ($request->payment_method == 'stripe') {

            return view('shop.payment.stripe', compact('data', 'cartTotal'));
        } elseif ($request->payment_method == 'card') {

            return 'card';
        } else {

            return view('shop.payment.cash', compact('data', 'cartTotal'));
        }
    }
}