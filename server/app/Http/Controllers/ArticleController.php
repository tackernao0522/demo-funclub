<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ArticleController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('articles.index', compact('posts'));
    }
}
