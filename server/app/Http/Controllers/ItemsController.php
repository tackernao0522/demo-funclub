<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOrderMail;
use App\Http\Requests\OrderRequest;
use App\Models\Item;
use App\User;
use App\Cart;
use App\Models\Order;
use Session;
use Carbon\Carbon;
use App\Models\PrimaryEcCategory;
use Stripe\Charge;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $categories = PrimaryEcCategory::query()
            ->with([
                'secondaryEcCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        $query = Item::query();

        // カテゴリで絞り込み
        if ($request->filled('category')) {
            list($categoryType, $categoryID) = explode(':', $request->input('category'));

            if ($categoryType === 'primary') {
                $query->whereHas('secondaryEcCategory', function ($query) use ($categoryID) {
                    $query->where('primary_ec_category_id', $categoryID);
                });
            } else if ($categoryType === 'secondary') {
                $query->where('secondary_ec_category_id', $categoryID);
            }
        }

        // キーワードで絞り込み
        if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', $keyword);
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }

        $defaults = [
            'category' => $request->input('category', ''),
            'keyword'  => $request->input('keyword', ''),
        ];

        // $items = $query->orderByRaw("FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')")
        //     ->orderBy('id', 'DESC')
        //     ->paginate(6);

        $items = $query->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(6);

        return view('items.items')
            ->with('categories', $categories)
            ->with('items', $items)
            ->with('defaults', $defaults);
    }

    public function showItemDetail(Item $item)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            if ($item->status == 0) {
                return redirect()->route('items.index')
                    ->with('status', $item->name . 'は販売していません。');
            }

            return view('items.item_detail')
                ->with('item', $item);
        } else {
            return redirect()->back()
                ->with('status', 'プレミアム会員限定販売です。');
        }
    }

    public function addToCart($id)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {

            // $items = Item::all();

            // foreach ($items as $item) {
            //     $status = $item->status;
            // }

            // if ($status == 0) {
            //     abort(404);
            // }

            $item = Item::find($id);
            if ($item->status == 0) {
                return redirect()->route('items.index')
                    ->with('status', $item->name . 'は販売していません。');
            }

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($item, $id);
            Session::put('cart', $cart);

            return back()
                ->with('status', $item->name . 'をカートに入れました。');
        }
    }

    public function update_qty(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $item = Item::find($id);

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->updateQty($id, $request->quantity);
            Session::put('cart', $cart);

            return back()->with('status', $item->name . 'の数量を ' . $request->quantity . ' に変更しました。');
        }
    }

    public function remove_from_cart($id)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $item = Item::find($id);

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);

            if (count($cart->items) > 0) {
                Session::put('cart', $cart);
            } else {
                Session::forget('cart');
            }

            return redirect()->route('cart.index')->with('status', $item->name . 'を削除しました。');
        }
    }

    public function cart()
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            if (!Session::has('cart')) {
                return view('items.cart.index');
            }
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);

            return view('items.cart.index', ['items' => $cart->items]);
        }
    }

    public function showBuyItemForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {

            if (!Session::has('cart')) {
                return redirect()->route('items.index')->with('status', 'カートの中身はありません。');
            }

            return view('items.item_buy_form');
        }
    }

    public function buyItem(OrderRequest $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);

            $payer_id = time();

            $order = new Order();
            $order->name = $request->input('name');
            $order->zip_code = $request->input('zip_code');
            $order->address = $request->input('address');
            $order->phone_number = $request->input('phone_number');
            $order->cart = serialize($cart);
            $order->payer_id = $payer_id;

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $charge = Charge::create(array(
                    "amount" => $cart->totalPrice,
                    "currency" => "jpy",
                    "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                    "description" => "Demofun Online Shop"
                ));
            } catch (\Exception $e) {
                Session::put('error', $e->getMessage());

                return redirect()->route('items.buy')->with('error', '購入処理に失敗しました。');
            }

            $order->save();

            $orders = Order::all();

            Session::forget('cart');

            $orders = Order::where('payer_id', $payer_id)->get();

            $orders->transform(function ($order, $key) {
                $order->cart = unserialize($order->cart);

                return $order;
                // php artisan make:migration add_payer_id_to_orders
            });


            // php artisan make:mail SendOrderMail
            Mail::to(Auth::user()->email)->send(new SendOrderMail($orders));

            return redirect()->route('cart.index')
                ->with('status', 'お支払いが完了しました。');
        }
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    private function settlement($itemID, $sellerID, $buyerID, $token)
    {
        DB::beginTransaction();

        try {
            $seller = User::lockForUpdate()->find($sellerID);
            $item = Item::lockForUpdate()->find($itemID);

            if ($item->isStateBought) {
                throw new \Exception('多重決済');
            }

            $item->state = Item::STATE_BOUGHT;
            $item->bought_at = Carbon::now();
            $item->buyer_id = $buyerID;
            $item->save();

            $seller->sales += $item->price;
            $seller->save();

            $charge = Charge::create([
                'card'     => $token,
                'amount'   => $item->price,
                'currency' => 'jpy'
            ]);
            if (!$charge->captured) {
                throw new \Exception('支払い確定失敗');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }
}
