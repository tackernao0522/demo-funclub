<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderBody;
use App\Information;

class InformationController extends Controller
{
    public function index()
    {
        $header_body = HeaderBody::where('id', 1)->first();
        $informations = Information::orderBy('created_at', 'desc')->get();
        return view('informations.index')
            ->with('header_body', $header_body)
            ->with('informations', $informations);
    }
}
