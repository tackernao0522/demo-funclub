<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\SellRequest;
use App\Http\Requests\EditItemRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\ShippingFeePayer;
use App\Models\PrimaryEcCategory;
use App\Models\DeliveryMethod;
use App\Models\DeliveryTime;

class SellController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showSellForm()
    {
        $categories = PrimaryEcCategory::query()
            ->with([
                'secondaryEcCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        $conditions = ItemCondition::orderBy('sort_no')->get();
        $shippingFeePayers = ShippingFeePayer::orderBy('sort_no')->get();
        $deliveryMethods = DeliveryMethod::orderBy('sort_no')->get();
        $deliveryTimes = DeliveryTime::orderBy('sort_no')->get();

        return view('admin.ec.sell')
            ->with('categories', $categories)
            ->with('conditions', $conditions)
            ->with('shippingFeePayers', $shippingFeePayers)
            ->with('deliveryMethods', $deliveryMethods)
            ->with('deliveryTimes', $deliveryTimes);
    }

    public function sellItem(SellRequest $request)
    {
        $user = Auth::user();

        $imageName = $this->saveImage($request->file('item-image'));

        $item = new Item();
        $item->item_image_name          = $imageName;
        $item->seller_id                = $user->id;
        $item->name                     = $request->input('name');
        $item->description              = $request->input('description');
        $item->stock                    = $request->input('stock');
        $item->secondary_ec_category_id = $request->input('ec_category');
        $item->item_condition_id        = $request->input('condition');
        $item->delivery_method_id       = $request->input('delivery');
        $item->delivery_time_id         = $request->input('delivery_time');
        $item->shipping_fee_payer_id    = $request->input('payer');
        $item->price                    = $request->input('price');
        $item->state                    = Item::STATE_SELLING;
        $item->save();

        return redirect()->route('sold-items')
            ->with('status', '商品を出品しました。');
    }

    public function itemEditForm(Item $item)
    {
        $categories = PrimaryEcCategory::query()
            ->with([
                'secondaryEcCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        $conditions = ItemCondition::orderBy('sort_no')->get();
        $shippingFeePayers = ShippingFeePayer::orderBy('sort_no')->get();
        $deliveryMethods = DeliveryMethod::orderBy('sort_no')->get();
        $deliveryTimes = DeliveryTime::orderBy('sort_no')->get();

        return view('admin.ec.item_edit', [
            'item' => $item,
            'categories' => $categories,
            'conditions' => $conditions,
            'shippingFeePayers' => $shippingFeePayers,
            'deliveryMethods' => $deliveryMethods,
            'deliveryTimes' => $deliveryTimes,
        ]);
    }

    public function editItem(EditItemRequest $request, Item $item)
    {
        if ($request->has('item-image')) {
            $fileName = $this->saveImage($request->file('item-image'));
            $item->item_image_name = $fileName;
        }

        $item->name                     = $request->input('name');
        $item->description              = $request->input('description');
        $item->stock                    = $request->input('stock');
        $item->secondary_ec_category_id = $request->input('ec_category');
        $item->item_condition_id        = $request->input('condition');
        $item->delivery_method_id       = $request->input('delivery');
        $item->delivery_time_id         = $request->input('delivery_time');
        $item->shipping_fee_payer_id    = $request->input('payer');
        $item->price                    = $request->input('price');
        $item->state                    = Item::STATE_SELLING;
        $item->save();

        return redirect()->route('sold-items')
            ->with('status', '商品ID：' . $item->id . 'を更新しました。');
    }

    public function destroy(Item $id)
    {
        $id->delete();

        return redirect()->route('sold-items',)
            ->with('status', $id->name . 'を削除しました。');
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(300, 300)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('item-images', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
