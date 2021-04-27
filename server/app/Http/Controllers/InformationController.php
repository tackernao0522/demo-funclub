<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HeaderBody;
use App\BigImage;
use App\Information;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::orderBy('updated_at', 'desc')->paginate(11);
        $header_body = HeaderBody::where('id', 1)->first();
        $big_image = BigImage::where('id', 1)->first();

        return view('informations.index')
            ->with('header_body', $header_body)
            ->with('big_image', $big_image)
            ->with('informations', $informations);
    }

    public function show(Information $information)
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $header_body = HeaderBody::where('id', 1)->first();

            return view('informations.show')
                ->with('header_body', $header_body)
                ->with('information', $information);
        } else {
            return redirect()->back()
                ->with('status', '有料会員のみ閲覧できます。');
        }
    }

    public function bigShow()
    {
        if (Auth::check() && Auth::user()->role === 'admin' || Auth::check() && Auth::user()->role === 'premium') {
            $header_body = HeaderBody::where('id', 1)->first();
            $big_image = BigImage::where('id', 1)->first();

            return view('informations.big_show')
                ->with('header_body', $header_body)
                ->with('big_image', $big_image);
        } else {
            return redirect()->back()
                ->with('status', '有料会員のみ閲覧できます。');
        }
    }
}
