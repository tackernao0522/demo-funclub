<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoHeaderBodyRequest;
use App\Http\Requests\BigImageRequest;
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

    public function editInfoHeaderBody(InfoHeaderBodyRequest $request, HeaderBody $headerBody)
    {
        $headerBody->info_header_body = $request->info_header_body;
        $headerBody->save();

        return redirect()->route('info.index')
            ->with('status', '更新しました。');
    }

    public function infoBigImageForm(BigImage $bigImage)
    {
        $bigImage = BigImage::where('id', 1)->first();

        return view('admin.big_image.form', ['bigImage' => $bigImage]);
    }

    public function editInfoBigImage(BigImageRequest $request, BigImage $bigImage)
    {
        if ($request->has('item-image')) {
            $fileName = $this->saveImage($request->file('item-image'));
            $bigImage->info_big_image_name = $fileName;
        }

        $bigImage->description = $request->description;

        $bigImage->save();

        return redirect()->route('info.index')
            ->with('status', '更新しました。');
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(665, 535)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('info-images', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
