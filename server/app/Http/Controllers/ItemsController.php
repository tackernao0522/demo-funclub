<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\User;
use App\Cart;
use Session;
use Carbon\Carbon;
use App\Models\PrimaryEcCategory;
use Payjp\Charge;

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

        $items = $query->orderByRaw("FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')")
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

            $item = Item::find($id);

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($item, $id);
            Session::put('cart', $cart);
            // dd(Session::get('cart'));

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

    public function showBuyItemForm(Item $item)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            if (!$item->isStateSelling) {
                abort(404);
            }

            return view('items.item_buy_form')
                ->with('item', $item);
        } else {
            return redirect()->back()
                ->with('status', 'プレミアム会員限定販売です。');
        }
    }

    public function buyItem(Request $request, Item $item)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $user = Auth::user();

            if (!$item->isStateSelling) {
                abort(404);
            }

            $token = $request->input('card-token');

            try {
                $this->settlement($item->id, $item->seller->id, $user->id, $token);
            } catch (\Exception $e) {
                Log::error($e);
                return redirect()->back()
                    ->with('type', 'danger')
                    ->with('message', '購入処理が失敗しました。');
            }

            return redirect()->route('item', [$item->id])
                ->with('message', '商品を購入しました。');
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
