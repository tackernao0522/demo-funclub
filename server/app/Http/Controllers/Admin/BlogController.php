<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function blogCategory()
    {
        if (auth()->user()->blog == 1) {
            $blogCategories = BlogPostCategory::orderBy('id', 'ASC')->get();

            return view('admin.shop.blog.category.category_view', compact('blogCategories'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function blogCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'blog_category_name' => 'required|unique:blog_post_categories',
        ], [
            'blog_category_name.required' => 'ブログカテゴリー名は必須です。',
            'blog_category_name.unique' => 'このカテゴリー名は既に登録されています。',
        ]);

        BlogPostCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug_name' => str_replace(' ', '-', $request->blog_category_name),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブログカテゴリーを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function blogCategoryEdit($id)
    {
        if (auth()->user()->blog == 1) {
            $blogCategory = BlogPostCategory::findOrFail($id);

            return view('admin.shop.blog.category.category_edit', compact('blogCategory'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function blogCategoryUpdate(Request $request, $id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);
        $validatedData = $request->validate([
            'blog_category_name' => 'required',
        ], [
            'blog_category_name.required' => 'ブログカテゴリー名は必須です。',
        ]);

        $blogCategory->blog_category_name = $request->blog_category_name;
        $blogCategory->blog_category_slug_name = str_replace(' ', '-', $request->blog_category_name);
        $blogCategory->updated_at = Carbon::now();
        $blogCategory->save();

        $notification = array(
            'message' => 'ブログカテゴリーID：' . $blogCategory->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('blog.category')
            ->with($notification);
    }

    public function categoryDelete($id)
    {
        if (auth()->user()->blog == 1) {
            $blogCategory = BlogPostCategory::findOrFail($id);

            $blogCategory->delete();

            $notification = array(
                'message' => 'ブログカテゴリー: ' . $blogCategory->blog_category_name  . 'を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function listBlogPost()
    {
        if (auth()->user()->blog == 1) {
            $blogPosts = BlogPost::with('category')->latest()->get();

            return view('admin.shop.blog.post.post_list', compact('blogPosts'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function addBlogPost()
    {
        if (auth()->user()->blog == 1) {
            $blogCategories = BlogPostCategory::latest()->get();
            $blogPosts =  BlogPost::latest()->get();

            return view('admin.shop.blog.post.post_add', compact('blogPosts', 'blogCategories'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function blogPostStore(Request $request)
    {
        $validatedData = $request->validate([
            'post_blog_title' => 'required|unique:blog_posts',
            'category_id' => 'required',
            'post_blog_image' => 'required|mimes:jpg,jpeg,png',
            'post_blog_details' => 'required|unique:blog_posts',
        ], [
            'post_blog_title.required' => 'ブログタイトルは必須です。',
            'post_blog_title.unique' => 'このブログタイトルは既に登録されています。',
            'category_id.required' => 'カテゴリーを選択してください。',
            'post_blog_image.required' => 'ブログ画像は必須です。',
            'post_blog_image.mimes' => 'ブログ画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
            'post_blog_details.required' => 'ブログ内容は必須です。',
            'post_blog_details.unique' => 'このブログ内容は既に投稿されています。',
        ]);

        $fileName = $this->saveImage($request->file('post_blog_image'));

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_blog_title' => $request->post_blog_title,
            'post_blog_slug' => str_replace(' ', '-', $request->post_blog_title),
            'post_blog_image' => $fileName,
            'post_blog_details' => $request->post_blog_details,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ブログを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->route('list.post')
            ->with($notification);
    }

    public function editBlogPost($id)
    {
        if (auth()->user()->blog == 1) {
            $blogCategories = BlogPostCategory::orderBy('id', 'ASC')->get();

            $blogPost = BlogPost::findOrFail($id);

            return view('admin.shop.blog.post.post_edit', compact('blogCategories', 'blogPost'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function blogPostUpdate(Request $request, $id)
    {
        $blogPost = BlogPost::findOrFail($id);

        $validatedData = $request->validate([
            'post_blog_title' => 'required',
            'category_id' => 'required',
            'post_blog_image' => 'mimes:jpg,jpeg,png',
            'post_blog_details' => 'required',
        ], [
            'post_blog_title.required' => 'ブログタイトルは必須です。',
            'category_id.required' => 'カテゴリーを選択してください。',
            'post_blog_image.mimes' => 'ブログ画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
            'post_blog_details.required' => 'ブログ内容は必須です。',
        ]);

        if ($request->has('post_blog_image')) {
            Storage::disk('s3')->delete('/blogs/' . $blogPost->post_blog_image);
            $blogPost->delete();
            $fileName = $this->saveImage($request->file('post_blog_image'));
            $blogPost->post_blog_image = $fileName;
        }

        $blogPost->post_blog_title = $request->post_blog_title;
        $blogPost->category_id = $request->category_id;
        $blogPost->post_blog_slug = str_replace(' ', '-', $request->post_blog_title);
        $blogPost->post_blog_details = $request->post_blog_details;
        $blogPost->updated_at = Carbon::now();
        $blogPost->save();

        $notification = array(
            'message' => 'ブログID: ' . $blogPost->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('list.post')
            ->with($notification);
    }

    public function blogPostDelete($id)
    {
        if (auth()->user()->blog == 1) {
            $blogPost = BlogPost::findOrFail($id);
            Storage::disk('s3')->delete('/blogs/' . $blogPost->post_blog_image);
            $blogPost->delete();

            $notification = array(
                'message' => 'ブログタイトル: ' . $blogPost->post_blog_title . 'を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(780, 433)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('blogs', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
