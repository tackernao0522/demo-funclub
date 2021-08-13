<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function sliderView()
    {
        $sliders = Slider::latest()->get();

        return view('admin.shop.slider.slider_view', compact('sliders'));
    }
}
