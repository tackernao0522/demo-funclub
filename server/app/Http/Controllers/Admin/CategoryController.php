<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function categoryView()
    {
        $categories = Category::latest()->get();

        return view('admin.shop.category.category_view', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories',
            'category_icon' => 'required|unique:categories',
        ], [
            'category_name.required' => 'カテゴリー名は必須です。',
            'category_name.unique' => 'このカテゴリー名は既に登録されています。',
            'category_icon.unique' => 'このアイコンはすでに使われています。',
            'category_icon.required' => 'カテゴリーアイコンは必須です。',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug_name' => str_replace(' ', '-', $request->category_name),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'カテゴリーを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
