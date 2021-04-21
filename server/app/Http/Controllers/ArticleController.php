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
        $posts = Post::all()->sortByDesc('post_date')->load('primaryCategory');
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $sub_title = SubTitle::where('id', 1)->first();

        return view('articles.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('sub_title', $sub_title);
    }

    public function categoryNews(PrimaryCategory $category)
    {
        $posts = Post::where('primary_category_id', $category->id)
            ->orderBy('post_date', 'desc')
            ->get()
            ->load('primaryCategory');
        $sub_title = SubTitle::where('id', 1)->first();

        return view('articles.show', [
            'category_name' => $category->name,
            'posts' => $posts,
            'sub_title' => $sub_title,
        ]);
    }
}
