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

    public function sliderEdit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('admin.shop.slider.slider_edit', compact('slider'));
    }

    public function sliderUpdate(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $validatedData = $request->validate([
            'slider_img' => 'mimes:jpg,jpeg,png',
        ], [
            'slider_img.mimes' => 'スライダー画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
        ]);

        if ($request->has('slider_img')) {
            Storage::disk('s3')->delete('/sliders/' . $slider->slider_img);
            $slider->delete();
            $fileName = $this->saveImage($request->file('slider_img'));
            $slider->slider_img = $fileName;
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->updated_at = Carbon::now();
        $slider->save();

        $notification = array(
            'message' => 'スライダーID：' . $slider->id . 'を更新しました(Slider Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-slider')
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
