<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddSliderRequest;
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

    public function sliderStore(AddSliderRequest $request)
    {
        $fileName = $this->saveImage($request->file('slider_img'));

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $fileName,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'スライダーを作成しました。(Slider Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(870, 370)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('sliders', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
