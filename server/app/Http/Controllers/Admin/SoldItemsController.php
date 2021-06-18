<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PrimaryEcCategory;
use App\Models\Item;

class SoldItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showSoldItems(Request $request)
    {
        $user = Auth::user();

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

        $items = $query->orderBy('id', 'DESC')->paginate(10);

        return view('admin.ec.sold_items')
            ->with('user', $user)
            ->with('categories', $categories)
            ->with('defaults', $defaults)
            ->with('items', $items);
    }

    public function activate_item($id)
    {
        $item = Item::find($id);

        $item->status = 1;

        $item->update();

        return redirect()->route('sold-items')
            ->with('status', $item->name . 'を出品開始しました。');
    }

    public function unactivate_item($id)
    {
        $item = Item::find($id);

        $item->status = 0;

        $item->update();

        return redirect()->route('sold-items')
            ->with('status', $item->name . 'を出品停止しました。');
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
