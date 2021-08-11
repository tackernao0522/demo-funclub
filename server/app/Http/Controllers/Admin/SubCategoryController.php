<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function subCategoryView()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subCategories = SubCategory::latest()->get();

        return view('admin.shop.category.subCategory_view', compact('categories', 'subCategories'));
    }

    public function subCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_name' => 'required|unique:sub_categories',

        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。',
            'subCategory_name.required' => 'サブカテゴリー名は必須です。',
            'subCategory_name.unique' => 'このサブカテゴリー名は既に登録されています。',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subCategory_name' => $request->subCategory_name,
            'subCategory_slug_name' => str_replace(' ', '-', $request->subCategory_name),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'サブカテゴリーを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
