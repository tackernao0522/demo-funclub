<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoHeaderBodyRequeset;
use Illuminate\Http\Request;
use App\HeaderBody;
use App\Information;
use App\BigImage;
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
        $big_image = BigImage::where('id', 1)->first();

        return view('admin.information.index')
            ->with('header_body', $header_body)
            ->with('big_image', $big_image)
            ->with('informations', $informations);
    }

    public function infoHeaderBodyEditForm(HeaderBody $headerBody)
    {
        $headerBody = HeaderBody::where('id', 1)->first();

        return view('admin.info_header_body.form', ['headerBody' => $headerBody]);
    }
}
