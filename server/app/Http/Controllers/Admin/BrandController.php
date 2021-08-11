<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Brand;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function brandView()
    {
        $brands = Brand::latest()->get();

        return view('admin.shop.brand.brand_view', compact('brands'));
    }

    public function brandStore(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands',
            'brand_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'brand_image.required' => 'ブランドロゴは必須です。',
            'brand_image.mimes' => 'ブランドロゴにはjpg, jpeg, png, svgのうちいずれかの形式のファイルを指定してください。'
        ]);

        $fileName = $this->saveImage($request->file('brand_image'));

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug_name' => str_replace(' ', '-', $request->brand_name),
            'brand_image' => $fileName,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブランドを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(300, 300)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('brands', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
