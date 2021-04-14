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
        // $categories = PrimaryCategory::orderBy('sort_no')->get();
        // dd($posts, $categories);
        return view('admin.posts.index')
            ->with('posts', $posts);
            // ->with('categories', $categories);
    }
}
