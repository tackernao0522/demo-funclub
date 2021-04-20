<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoHeaderBodyRequest;
use App\Http\Requests\BigImageRequest;
use App\Http\Requests\CreateInfoRequest;
use App\Http\Requests\EditSmallImageRequest;
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
        $informations = Information::orderBy('updated_at', 'desc')->get();
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
        if ($request->has('info_big_image_name')) {
            $fileName = $this->saveImage($request->file('info_big_image_name'));
            $bigImage->info_big_image_name = $fileName;
        }

        $bigImage->description = $request->description;

        $bigImage->save();

        return redirect()->route('info.index')
            ->with('status', '更新しました。');
    }

    public function informationCreateForm()
    {
        return view('admin.information.form');
    }

    public function informationCreate(CreateInfoRequest $request)
    {
        $imageInfoName = $this->saveSmallImage($request->file('info_image_name'));

        $Information = new Information();
        $Information->info_image_name = $imageInfoName;
        $Information->description = $request->description;

        $Information->save();

        return redirect()->route('info.index')
            ->with('status', 'Infoを投稿しました。');
    }

    public function infoSmallImageForm(Information $smallImage)
    {
        return view('admin.information.small_edit_form', ['smallImage' => $smallImage]);
    }

    public function editInfoSmallImage(EditSmallImageRequest $request, Information $smallImage)
    {
        if ($request->has('info_image_name')) {
            $smallInfofileName = $this->saveSmallImage($request->file('info_image_name'));
            $smallImage->info_image_name = $smallInfofileName;
        }

        $smallImage->description = $request->description;
        $smallImage->save();

        return redirect()->route('info.index')
            ->with('status', 'Infoを編集しました。');
    }

    public function destroy(Information $id)
    {
        $id->delete();

        return redirect()->route('info.index')
            ->with('status', 'infoを削除しました。');
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(665, 535)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('big-info-images', new File($tempPath));

        return basename($filePath);
    }

    private function saveSmallImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(318, 236)->save($tempPath);

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
