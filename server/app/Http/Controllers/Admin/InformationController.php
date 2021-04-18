<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HeaderBody;
use App\Information;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $informations = Information::orderBy('created_at', 'desc')->get();
        $header_body = HeaderBody::where('id', 1)->first();

        return view('admin.information.index')
            ->with('header_body', $header_body)
            ->with('informations', $informations);
    }
}
