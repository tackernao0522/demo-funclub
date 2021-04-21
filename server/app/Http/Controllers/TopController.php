<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopTitle;

class TopController extends Controller
{
    public function index()
    {
        $top = TopTitle::where('id', 1)->first();

        return view('top')->with('top', $top);
    }
}
