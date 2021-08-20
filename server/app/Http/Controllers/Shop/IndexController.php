<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Blog\BlogPostCategory;
// use App\Models\BlogPost;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(6)->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
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
        // $skip_brand_9 = Brand::skip(9)->first();
        // $skip_brand_product_9 = Product::where('status', 1)
        //     ->where('brand_id', $skip_brand_9->id)
        //     ->orderBy('id', 'DESC')->get();
        // $blogPosts = BlogPost::latest()->get();

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
            // 'skip_brand_9',
            // 'skip_brand_product_9',
            // 'blogPosts',
        ));
    }
}
