<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PrimaryCategory;

class ArticleController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $categories = PrimaryCategory::orderBy('sort_no')->get();

        return view('articles.index')
            ->with('posts', $posts)
            ->with('categories', $categories);
    }

    public function categoryNews(PrimaryCategory $category)
    {
        $category = PrimaryCategory::find($category->id);
        $posts = Post::where('primary_category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('articles.show', [
            'category_name' => $category->name,
            'posts' => $posts,
        ]);
    }
}
