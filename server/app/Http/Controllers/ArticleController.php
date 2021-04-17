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
        $posts = Post::orderBy('post_date', 'desc')->get();
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $sub_titles = SubTitle::with('post')->get();

        return view('articles.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('sub_titles', $sub_titles);
    }

    public function categoryNews(PrimaryCategory $category)
    {
        $posts = Post::where('primary_category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $sub_titles = SubTitle::with('post')->get();

        return view('articles.show', [
            'category_name' => $category->name,
            'posts' => $posts,
            'sub_titles' => $sub_titles,
        ]);
    }
}
