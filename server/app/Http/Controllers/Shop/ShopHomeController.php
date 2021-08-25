<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;

class ShopHomeController extends Controller
{
    public function addBlogPost()
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts = BlogPost::latest()->get();

        return view('shop.blog.blog_list', compact('blogCategories', 'blogPosts'));
    }
}
