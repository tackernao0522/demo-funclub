<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function viewWishlist()
    {
        return view('shop.wishlist.view_wishlist');
    }
}
