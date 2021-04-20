<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderBody;
use App\BigImage;
use App\Information;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::orderBy('updated_at', 'desc')->get();
        $header_body = HeaderBody::where('id', 1)->first();
        $big_image = BigImage::where('id', 1)->first();

        return view('informations.index')
            ->with('header_body', $header_body)
            ->with('big_image', $big_image)
            ->with('informations', $informations);
    }
}
