<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\MultiImg;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('admin.shop.product.product_add', compact('categories', 'brands'));
    }

    public function storeProduct(AddProductRequest $request)
    {
        // if ($files = $request->file('file')) {
        //     $destinationPath = 'products/pdf';
        //     $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //     $file_store_disk = 's3';  // local または public または s3
        //     $digital_file_name = $request->file('file')->storeAs($destinationPath, $digitalItem, $file_store_disk);      // ディレクトリ, ファイル名, ディスク
        // }

        $fileName = $this->saveImage($request->file('product_thambnail'));

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subCategory_id' => $request->subCategory_id,
            'subSubCategory_id' => $request->subSubCategory_id,
            'product_name' => $request->product_name,
            'product_slug_name' => str_replace(' ', '-', $request->product_name),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_name' => $request->product_tags_name,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'product_thambnail' => $fileName,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            // 'digital_file' => $digitalItem,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');

        foreach ($images as $img) {
            $tempPath2 = $this->makeTempPath();
            Image::make($img)->resize(917, 1000)->save($tempPath2);

            $filePath2 = Storage::disk('s3')
                ->putFile('products/multi-image', new File($tempPath2));

            $multiImageName = basename($filePath2);

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $multiImageName,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => '商品を登録しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(917, 1000)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('products/thambnail', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
