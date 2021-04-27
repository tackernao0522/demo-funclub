<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PrimaryCategory;
use App\SubTitle;

class ArticleController extends Controller
{
    public function index()
    {
        $posts = Post::with(['primaryCategory'])->orderBy('post_date', 'desc')->paginate(15);
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $sub_title = SubTitle::where('id', 1)->first();

        return view('articles.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('sub_title', $sub_title);
    }

    public function categoryNews(PrimaryCategory $category)
    {
        $posts = Post::with('primaryCategory')
            ->where('primary_category_id', $category->id)
            ->orderBy('post_date', 'desc')
            ->paginate(15);
        $sub_title = SubTitle::where('id', 1)->first();

        return view('articles.show', [
            'category_name' => $category->name,
            'posts' => $posts,
            'sub_title' => $sub_title,
        ]);
    }
}
