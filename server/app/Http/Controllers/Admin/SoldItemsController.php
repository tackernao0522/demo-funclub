<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showSoldItems()
    {
        $user = Auth::user();

        $items = $user->soldItems()->orderBy('id', 'DESC')->get();

        return view('admin.ec.sold_items')
            ->with('items', $items);
    }
}
