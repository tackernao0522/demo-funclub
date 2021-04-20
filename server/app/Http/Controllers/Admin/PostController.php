<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticle;
use App\Http\Requests\SubTitleRequest;
use App\Http\Requests\EditCreateRequest;
use Illuminate\Http\Request;
use App\Post;
use App\PrimaryCategory;
use App\SubTitle;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $sub_title = SubTitle::where('id', 1)->first();

        return view('admin.posts.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('sub_title', $sub_title);
    }

    public function articleCreateForm()
    {
        $categories = PrimaryCategory::orderBy('sort_no')->get();

        return view('admin.posts.form', ['categories' => $categories]);
    }

    public function articleCreate(CreateArticle $request)
    {
        $imageArticleName = $this->saveImage($request->file('post_image_name'));

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
        $sub_title = SubTitle::where('id', 1)->first();

        return view('admin.posts.show', [
            'category_name' => $category->name,
            'posts' => $posts,
            'sub_title' => $sub_title,
        ]);
    }

    public function articleEditForm(Post $post)
    {
        $categories = PrimaryCategory::orderBy('sort_no')->get();

        return view('admin.posts.edit_form', ['post' => $post, 'categories' => $categories]);
    }

    public function editArticle(EditCreateRequest $request, Post $post)
    {
        if ($request->has('post_image_name')) {
            $fileName = $this->saveImage($request->file('post_image_name'));
            $post->post_image_name = $fileName;
        }

        $post->post_title = $request->post_title;
        $post->post_date = $request->post_date;
        $post->body = $request->body;
        $post->primary_category_id = $request->input('primary_category');

        $post->save();

        return redirect()->route('posts.index')
            ->with('status', 'ニュースを更新しました。');
    }

    public function destroy(Post $id)
    {
        $id->delete();

        return redirect()->route('posts.index')
            ->with('status', 'ニュースを削除しました。');
    }

    public function subTitleEditForm(SubTitle $subTitle)
    {
        $subTitle = SubTitle::where('id', 1)->first();
        return view('admin.sub_title.form', ['subTitle' => $subTitle]);
    }

    public function editSubTitle(SubTitleRequest $request, SubTitle $subTitle)
    {
        $subTitle->sub_title = $request->sub_title;
        $subTitle->description = $request->description;

        $subTitle->save();

        return redirect()->route('posts.index')
            ->with('status', '更新しました。');
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
