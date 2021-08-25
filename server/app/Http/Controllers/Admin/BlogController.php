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
    public function blogCategory()
    {
        $blogCategories = BlogPostCategory::orderBy('id', 'ASC')->get();

        return view('admin.shop.blog.category.category_view', compact('blogCategories'));
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
        $blogCategory = BlogPostCategory::findOrFail($id);

        return view('admin.shop.blog.category.category_edit', compact('blogCategory'));
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
        $blogCategory = BlogPostCategory::findOrFail($id);

        $blogCategory->delete();

        $notification = array(
            'message' => 'ブログカテゴリー: ' . $blogCategory->blog_category_name  . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
