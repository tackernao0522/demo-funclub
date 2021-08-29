<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
    public function shopPage()
    {
        $products = Product::query();
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')
                ->whereIn('category_slug_name', $slugs)
                ->pluck('id')
                ->toArray();
            $products = $products->whereIn('category_id', $catIds)->paginate(3);
        }
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brandIds = Brand::select('id')
                ->whereIn('brand_slug_name', $slugs)
                ->pluck('id')
                ->toArray();
            $products = $products->whereIn('brand_id', $brandIds)->paginate(3);
        } else {
            $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(3);
        }

        $brands = Brand::orderBy('id', 'ASC')->get();
        $categories = Category::orderBy('id', 'ASC')->get();

        return view('shop.shop_page', compact('products', 'categories', 'brands'));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();

        if (!empty($data['category']) && !empty($data['brand'])) {
            $notification = array(
                'message' => 'カテゴリーとブランドを併せて検索できません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }

        // Filter Category
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            } // end foreach condition
        } // end if condition

        // Filter Brand
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            } // end foreach condition
        } // end if condition

        return redirect()->route('shop.page', $catUrl . $brandUrl);
    }
}
