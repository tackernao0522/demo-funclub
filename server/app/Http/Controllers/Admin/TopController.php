<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TopTitleRequest;
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

        return view('admin.top.title_form', ['top' => $top]);
    }

    public function editTopTitle(TopTitleRequest $request, TopTitle $top)
    {
        $top->main_title = $request->main_title;
        $top->content = $request->content;
        $top->save();

        return redirect()->route('top')
            ->with('status', '更新しました。');
    }
}
