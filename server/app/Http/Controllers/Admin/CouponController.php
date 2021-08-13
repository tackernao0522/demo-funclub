<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function couponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();

        return view('admin.shop.coupon.view_coupon', compact('coupons'));
    }

    public function couponStore(Request $request)
    {
        $validatedData = $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required|integer',
            'coupon_validity' => 'required',
        ], [
            'coupon_name.required' => 'クーポン名は必須です。',
            'coupon_discount.required' => '割引率は必須です。',
            'coupon_discount.integer' => '割引率は半角数字を指定してください。',
            'coupon_validity.required' => '有効期限は必須です。',
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'クーポンを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function couponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.shop.coupon.edit_coupon', compact('coupon'));
    }

    public function couponUpdate(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $validatedData = $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required|integer',
        ], [
            'coupon_name.required' => 'クーポン名は必須です。',
            'coupon_discount.required' => '割引率は必須です。',
            'coupon_discount.integer' => '割引率は半角数字を指定してください。',
        ]);

        $coupon->coupon_name = strtoupper($request->coupon_name);
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->updated_at = Carbon::now();
        $coupon->save();

        $notification = array(
            'message' => 'クーポンID：' . $coupon->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-coupon')
            ->with($notification);
    }
}
