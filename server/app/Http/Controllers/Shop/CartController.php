<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\ShipDivision;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);

        if ($product->product_qty <= 0) {
            return response()->json(['error' => '売り切れです。']);
        }


        if ($product->discount_price == NULL) {
            if ($product->product_qty < $request->quantity) {
                return response()->json([
                    'success' => $product->product_name . 'の在庫が足りません。'
                ]);
            }

            foreach (Cart::content() as $row) {
                $products = Product::where('id', $product->id)->where('id', $row->id)->get();
                foreach ($products as $product) {
                    if ($product->product_qty < $row->qty + $request->quantity) {
                        return response()->json([
                            'success' => $product->product_name . 'の在庫が足りません。'
                        ]);
                    }
                }
            }
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'カートに追加しました。']);
        } else {
            if ($product->product_qty < $request->quantity) {
                return response()->json([
                    'success' => $product->product_name . 'の在庫が足りません。'
                ]);
            }

            foreach (Cart::content() as $row) {
                $products = Product::where('id', $product->id)->where('id', $row->id)->get();
                foreach ($products as $product) {
                    if ($product->product_qty < $row->qty + $request->quantity) {
                        return response()->json([
                            'success' => $product->product_name . 'の在庫が足りません。'
                        ]);
                    }
                }
            }
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'カートに追加しました。']);
        }
    }

    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        if (Session::has('coupon')) {

            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => session()->get('coupon')['total_amount'],
            ));
        } else {

            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal,
            ));
        }
    }

    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
        Session::forget('coupon');

        return response()->json(['success' => 'カート内商品を削除しました。']);
    }

    public function AddToWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(['success' => 'ウイッシュリストに追加しました。']);
            } else {

                return response()->json(['error' => 'この商品は既にウイッシュリストに入っています。']);
            }
        } else {

            return response()->json(['error' => 'ログインしてください。']);
        }
    }

    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => floor((int) Cart::total() * (int) $coupon->coupon_discount / 100),
                'total_amount' => ceil((int) Cart::total() - (int) Cart::total() * (int) $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'クーポンが適用されました。',
            ));
        } else {
            return response()->json(['error' => '無効なクーポンです。']);
        }
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')) {

            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {

            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    public function couponRemove()
    {
        Session::forget('coupon');

        return response()->json(['error' => 'クーポンを削除しました。']);
    }

    public function checkoutCreate()
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

        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderBy('id', 'ASC')->get();

                return view('shop.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
            } else {
                $notification = array(
                    'message' => 'カートに商品は入っていません。',
                    'alert-type' => 'error'
                );

                return redirect()->route('shop.index')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'ログインしてください。',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
