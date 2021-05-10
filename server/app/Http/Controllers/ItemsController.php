<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $items = Item::orderByRaw("FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')")
            ->orderBy('id', 'DESC')
            ->paginate(6);

        return view('items.items')
            ->with('items', $items);
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
}
