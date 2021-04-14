<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\PrimaryCategory;
use App\SubTitle;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $posts = Post::all();
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $sub_titles = SubTitle::with('post')->get();

        return view('admin.posts.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('sub_titles', $sub_titles);
    }

    public function categoryShow(PrimaryCategory $category)
    {
        $posts = Post::where('primary_category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $sub_titles = SubTitle::with('post')->get();

        return view('admin.posts.show', [
            'category_name' => $category->name,
            'posts' => $posts,
            'sub_titles' => $sub_titles,
        ]);
    }
}
