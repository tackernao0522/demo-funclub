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

    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.shop.category.category_edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validatedData = $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name.required' => 'カテゴリー名は必須です。',
            'category_icon.required' => 'カテゴリーアイコンは必須です。',
        ]);

        $category->category_name = $request->category_name;
        $category->category_slug_name = str_replace(' ', '-', $request->category_name);
        $category->category_icon = $request->category_icon;
        $category->updated_at = Carbon::now();
        $category->save();

        $notification = array(
            'message' => 'カテゴリーID：' . $category->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.category')
            ->with($notification);
    }

    public function categoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if (SubCategory::where('category_id', $category->id)->first()) {
            $subCategory = SubCategory::where('category_id', $category->id)->first();
            $subCategory->delete();
        }
        // if (SubSubCategory::where('category_id', $category->id)->first()) {
        //     $subSubCategory = SubSubCategory::where('category_id', $category->id)->first();
        //     $subSubCategory->delete();
        // }

        $notification = array(
            'message' => 'カテゴリー：' . $category->category_name . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
