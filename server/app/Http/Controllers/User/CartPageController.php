<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;

class CartPageController extends Controller
{
    public function myCart()
    {
        return view('shop.wishlist.view_mycart');
    }
}
