<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\PrimaryCategory;
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
        // dd($posts, $categories);
        return view('admin.posts.index')
            ->with('posts', $posts)
            ->with('categories', $categories);
    }

    public function categoryShow(PrimaryCategory $category)
    {
        $categories = PrimaryCategory::all();
        $posts = Post::where('primary_category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.posts.show', [
            'category_name' => $category->name,
            'posts' => $posts,
        ]);
    }
}
