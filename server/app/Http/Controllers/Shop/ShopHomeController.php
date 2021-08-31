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

    public function detailsBlogPost($id)
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);

        return view('shop.blog.blog_details', compact('blogPost', 'blogCategories'));
    }

    public function shopHomeBlogCatPost($category_id)
    {
        $blogCategories = BlogPostCategory::latest()->get();
        $blogPosts = BlogPost::where('category_id', $category_id)
            ->orderBy('id', 'DESC')
            ->paginate(3);

        return view('shop.blog.blog_cat_list', compact('blogCategories', 'blogPosts'));
    }
}
