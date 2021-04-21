<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TopTitle;

class TopController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function topTitleForm(TopTitle $top)
    {
        $top = TopTitle::where('id', 1)->first();

        return view('admin.top.title', ['top' => $top]);
    }
}
