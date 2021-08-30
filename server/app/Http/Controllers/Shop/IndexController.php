<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\BlogPost;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(6)->get();
        $categories = Category::orderBy('id', 'ASC')->get();
        $sliders = Slider::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(3)->get();
        $featured = Product::where('featured', 1)
            ->orderBy('id', 'DESC')
            ->limit(6)->get();
        $hot_deals = Product::where('hot_deals', 1)
            ->where('discount_price', '!=', NULL)
            ->orderBy('id', 'DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer', 1)
            ->orderBy('id', 'DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals', 1)
            ->orderBy('id', 'DESC')->limit(3)->get();
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)
            ->where('category_id', $skip_category_0->id)
            ->orderBy('id', 'DESC')->get();
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)
            ->where('category_id', $skip_category_1->id)
            ->orderBy('id', 'DESC')->get();
        $skip_brand_9 = Brand::skip(9)->first();
        $skip_brand_product_9 = Product::where('status', 1)
            ->where('brand_id', $skip_brand_9->id)
            ->orderBy('id', 'DESC')->get();
        $blogPosts = BlogPost::latest()->get();

        // return $skip_category->id;
        // die();

        return view('shop.index', compact(
            'categories',
            'sliders',
            'products',
            'featured',
            'hot_deals',
            'special_offer',
            'special_deals',
            'skip_category_0',
            'skip_product_0',
            'skip_category_1',
            'skip_product_1',
            'skip_brand_9',
            'skip_brand_product_9',
            'blogPosts',
        ));
    }

    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $color_name = $product->product_color;
        $product_color = explode(',', $color_name);

        $size_name = $product->product_size;
        $product_size = explode(',', $size_name);

        $multiImage = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)
            ->where('id', '!=', $id)->orderBy('id', 'DESC')->get();

        return view('shop.product_details', compact(
            'product',
            'multiImage',
            'product_color',
            'product_size',
            'relatedProduct',
        ));
    }

    public function tagWiseProduct($tag)
    {
        $products = Product::where('status', 1)
            ->where('product_tags_name', $tag)
            ->orderBy('id', 'DESC')->paginate(3);

        $breadTag = Product::where('product_tags_name', $tag)->first();

        $categories = Category::orderBy('id', 'ASC')->get();

        return view('shop.tags.tags_view', compact('products', 'breadTag', 'categories'));
    }

    public function subCatWiseProduct(Request $request, $subCat_id)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $subCat_id)->orderBy('id', 'ASC')->paginate(3);

        $categories = Category::orderBy('id', 'ASC')->get();

        $breadSubCat = SubCategory::with(['category'])->where('id', $subCat_id)->get();

        // Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('shop.grid_view_product', compact('products'))->render();

            $list_view = view('shop.list_view_product', compact('products'))->render();

            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);
        }
        // End Load More Product with Ajax

        return view('shop.subCategory_view', compact('products', 'categories', 'breadSubCat'));
    }

    public function subSubCatWiseProduct($subSubCat_id)
    {
        $products = Product::where('status', 1)->where('subSubCategory_id', $subSubCat_id)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('id', 'ASC')->get();

        $breadSubSubCat = SubSubCategory::with(['category', 'subCategory'])->where('id', $subSubCat_id)->get();

        return view('shop.sub_subCategory_view', compact('products', 'categories', 'breadSubSubCat'));
    }

    public function productViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function productSearch(Request $request)
    {
        $request->validate(["search" => "required"]);

        $item = $request->search;
        // echo "$item";
        $categories = Category::orderBy('id', 'ASC')->get();
        $products = Product::where('product_name', 'LIKE', "%$item%")->get();

        return view('shop.product.search', compact('products', 'item', 'categories'));
    }

    public function searchProduct(Request $request)
    {
        $request->validate(["search" => "required"]);

        $item = $request->search;

        $products = Product::where('product_name', 'LIKE', "%$item%")
            ->select('product_name', 'product_thambnail', 'selling_price', 'id', 'product_slug_name')
            ->limit(5)
            ->get();

        return view('shop.product.search_product', compact('products'));
    }
}
