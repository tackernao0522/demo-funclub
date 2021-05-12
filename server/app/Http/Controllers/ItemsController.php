<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\PrimaryEcCategory;

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

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }
}
