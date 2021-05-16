<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.price', 'items.item_condition_id', 'items.item_image_name', 'items.shipping_fee_payer_id', 'items.secondary_ec_category_id')
                ->where('user_id', Auth::id())
                ->join('items', 'items.id', '=', 'cart_items.item_id')
                ->get();

            $subtotal = 0;
            foreach ($cartitems as $cartitem) {
                $subtotal += $cartitem->price * $cartitem->quantity;
            }

            return view('items.cart_items.index', ['cartitems' => $cartitems, 'subtotal' => $subtotal]);
        }
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            CartItem::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'item_id' => $request->post('item_id'),
                ],
                [
                    'quantity' => \DB::raw('quantity + ' . $request->post('quantity')),
                ]
            );

            return redirect()->route('items.index')
                ->with('status', 'カートに追加しました');
        }
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect('cartItems')->with('danger_error', 'カートから削除しました。');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $cartItem->quantity = $request->post('quantity');
        $cartItem->save();

        return redirect('cartItems')->with('status', 'カートを更新しました。');
    }
}
