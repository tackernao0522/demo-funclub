<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class IndexController extends Controller
{
    public function userDashboard()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('user.dashboard', compact('user'));
    }
}
