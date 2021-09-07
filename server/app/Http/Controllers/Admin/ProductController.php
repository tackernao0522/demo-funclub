<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
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
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function addProduct()
    {
        if (auth()->user()->product == 1) {
            $categories = Category::latest()->get();
            $brands = Brand::latest()->get();

            return view('admin.shop.product.product_add', compact('categories', 'brands'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function storeProduct(AddProductRequest $request)
    {
        // if ($files = $request->file('digital_file')) {
        //     $destinationPath = 'products/pdf';
        //     $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //     $file_store_disk = 's3';  // local または public または s3
        //     $digital_file_name = $request->file('digital_file')->storeAs($destinationPath, $digitalItem, $file_store_disk);      // ディレクトリ, ファイル名, ディスク
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

        if ($request->file('multi_img')) {
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
        }

        $notification = array(
            'message' => '商品を登録しました。',
            'alert-type' => 'success',
        );

        return redirect()->route('manage-product')
            ->with($notification);
    }

    public function manegeProduct()
    {
        if (auth()->user()->product == 1) {
            $products = Product::latest()->get();

            return view('admin.shop.product.product_view', compact('products'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function productEdit($id)
    {
        if (auth()->user()->product == 1) {
            $multiImgs = MultiImg::where('product_id', $id)->get();
            $categories = Category::latest()->get();
            $brands = Brand::latest()->get();
            $subCategories = SubCategory::latest()->get();
            $subSubCategories = SubSubCategory::latest()->get();
            $product = Product::findOrFail($id);

            return view('admin.shop.product.product_edit', compact(
                'multiImgs',
                'categories',
                'brands',
                'subCategories',
                'subSubCategories',
                'product'
            ));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function productDataUpdate(EditProductRequest $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
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
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '商品ID：' . $product_id . 'を更新しました。',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function multiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        if ($imgs) {
            foreach ($imgs as $id => $img) {
                $imgDel = MultiImg::findOrFail($id);
                Storage::disk('s3')->delete('products/multi-image/' . $imgDel->photo_name);
                $imgDel->delete();

                $tempPath2 = $this->makeTempPath();
                Image::make($img)->resize(917, 1000)->save($tempPath2);

                $filePath2 = Storage::disk('s3')
                    ->putFile('products/multi-image', new File($tempPath2));

                $multiImageName = basename($filePath2);

                $imgDel->photo_name = $multiImageName;
                $imgDel->updated_at = Carbon::now();
                $imgDel->save();
            }
        }

        $notification = array(
            'message' => '画像を更新しました。',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function thambnailImageUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validatedData = $request->validate([
            'product_thambnail' => 'mimes:jpg,jpeg,png',
        ], [
            'product_thambnail.mimes' => 'メインサムネイルにはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
        ]);

        if ($request->has('product_thambnail')) {
            Storage::disk('s3')->delete('/products/thambnail/' . $product->product_thambnail);
            $product->delete();
            $fileName = $this->saveImage($request->file('product_thambnail'));
            $product->product_thambnail = $fileName;
            $product->updated_at = Carbon::now();
            $product->save();
        }

        $notification = array(
            'message' => 'サムネイルを更新しました。',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function multiImageDelete($id)
    {
        if (auth()->user()->product == 1) {
            $multiImg = MultiImg::findOrFail($id);
            Storage::disk('s3')->delete('/products/multi-image/' . $multiImg->photo_name);
            $multiImg->delete();

            $notification = array(
                'message' => 'マルチ画像ID：' . $multiImg->id . 'を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function productInactive($id)
    {
        if (auth()->user()->product == 1) {
            Product::findOrFail($id)->update(['status' => 0]);

            $notification = array(
                'message' => '販売停止しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function productActive($id)
    {
        if (auth()->user()->product == 1) {
            Product::findOrFail($id)->update(['status' => 1]);

            $notification = array(
                'message' => '販売開始しました。',
                'alert-type' => 'success',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function productDelete($id)
    {
        if (auth()->user()->product == 1) {
            $product = Product::findOrFail($id);
            Storage::disk('s3')->delete('/products/thambnail/' . $product->product_thambnail);
            // Storage::disk('s3')->delete('/products/pdf/' . $product->digital_file);
            $product->delete();

            $images = MultiImg::where('product_id', $id)->get();
            foreach ($images as $image) {
                Storage::disk('s3')->delete('/products/multi-image/' . $image->photo_name);
                MultiImg::where('product_id', $id)->delete();
            }

            $notification = array(
                'message' => '商品を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function productStock()
    {
        if (auth()->user()->stock == 1) {
            $products = Product::latest()->get();

            return view('admin.shop.product.product_stock', compact('products'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
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
