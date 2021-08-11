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

    public function subCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $subCategory = SubCategory::findOrFail($id);

        return view('admin.shop.category.subCategory_edit', compact('categories', 'subCategory'));
    }

    public function subCategoryUpdate(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_name' => 'required',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。',
            'subCategory_name.required' => 'サブカテゴリー名は必須です。',
        ]);

        $subCategory->category_id = $request->category_id;
        $subCategory->subCategory_name = $request->subCategory_name;
        $subCategory->subCategory_slug_name = str_replace(' ', '-', $request->subCategory_name);
        $subCategory->updated_at = Carbon::now();
        $subCategory->save();

        $notification = array(
            'message' => 'サブカテゴリーID：' . $subCategory->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.subCategory')
            ->with($notification);
    }

    public function subCategoryDelete($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        // if (SubSubCategory::where('subCategory_id', $subCategory->id)->first()) {
        //     $subSubCategory = SubSubCategory::where('subCategory_id', $subCategory->id)->first();
        //     $subSubCategory->delete();
        // }

        $notification = array(
            'message' => 'サブカテゴリー：' . $subCategory->subCategory_name . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }

    // That for Sub-Sub->SubCategory
    public function subSubCategoryView()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();

        return view('admin.shop.category.sub_subCategory_view', compact('categories', 'subSubCategories'));
    }

    public function getSubCategory($category_id)
    {
        $subCat = SubCategory::where('category_id', $category_id)
            ->orderBy('subCategory_name', 'ASC')->get();

        return json_encode($subCat);
    }

    public function getSubSubCategory($subCategory_id)
    {
        $subSubCat = SubSubCategory::where('subCategory_id', $subCategory_id)
            ->orderBy('subSubCategory_name', 'ASC')->get();

        return json_encode($subSubCat);
    }
}
