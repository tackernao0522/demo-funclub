<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticle;
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
        $posts = Post::orderBy('post_date', 'desc')->get();
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $sub_titles = SubTitle::with('post')->get();

        return view('admin.posts.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('sub_titles', $sub_titles);
    }

    public function articleCreateForm()
    {
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        return view('admin.posts.form')
            ->with('categories', $categories);
    }

    public function articleCreate(CreateArticle $request)
    {
        $imageArticleName = $this->saveImage($request->file('item-image'));

        $post = new Post();
        $post->post_image_name = $imageArticleName;
        $post->post_title = $request->post_title;
        $post->post_date = $request->post_date;
        $post->body = $request->body;
        $post->primary_category_id = $request->input('primary_category');

        $post->save();

        return redirect()->route('posts.index')
            ->with('status', 'ニュースを投稿しました。');
    }

    public function categoryShow(PrimaryCategory $category)
    {
        $posts = Post::where('primary_category_id', $category->id)
            ->orderBy('post_date', 'desc')
            ->paginate(10);
        $sub_titles = SubTitle::with('post')->get();

        return view('admin.posts.show', [
            'category_name' => $category->name,
            'posts' => $posts,
            'sub_titles' => $sub_titles,
        ]);
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(754, 424)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('article-images', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
