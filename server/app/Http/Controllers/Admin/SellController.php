<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCondition;
use App\Models\PrimaryEcCategory;

class SellController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showSellForm()
    {
        $categories = PrimaryEcCategory::query()
            ->with([
                'secondaryEcCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        $conditions = ItemCondition::orderBy('sort_no')->get();

        return view('admin.ec.sell')
            ->with('categories', $categories)
            ->with('conditions', $conditions);
    }
}
