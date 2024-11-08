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
        if (auth()->user()->category == 1) {
            $categories = Category::orderBy('id', 'ASC')->get();
            $subCategories = SubCategory::with(['category'])->orderBy('id', 'ASC')->get();

            return view('admin.shop.category.subCategory_view', compact('categories', 'subCategories'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function subCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_name' => 'required',

        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。',
            'subCategory_name.required' => 'サブカテゴリー名は必須です。',
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
        if (auth()->user()->category == 1) {
            $categories = Category::orderBy('category_name', 'ASC')->get();

            $subCategory = SubCategory::findOrFail($id);

            return view('admin.shop.category.subCategory_edit', compact('categories', 'subCategory'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
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
        if (auth()->user()->category == 1) {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->delete();
            if (SubSubCategory::where('subCategory_id', $subCategory->id)->first()) {
                $subSubCategory = SubSubCategory::where('subCategory_id', $subCategory->id)->first();
                $subSubCategory->delete();
            }

            $notification = array(
                'message' => 'サブカテゴリー：' . $subCategory->subCategory_name . 'を削除しました。',
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

    // That for Sub-Sub->SubCategory
    public function subSubCategoryView()
    {
        if (auth()->user()->category == 1) {
            $categories = Category::orderBy('id', 'ASC')->get();
            $subSubCategories = SubSubCategory::with(['category', 'subCategory'])->orderBy('id', 'ASC')->get();

            return view('admin.shop.category.sub_subCategory_view', compact('categories', 'subSubCategories'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function getSubCategory($category_id)
    {
        $subCat = SubCategory::where('category_id', $category_id)
            ->orderBy('id', 'ASC')->get();

        return json_encode($subCat);
    }

    public function getSubSubCategory($subCategory_id)
    {
        $subSubCat = SubSubCategory::where('subCategory_id', $subCategory_id)
            ->orderBy('id', 'ASC')->get();

        return json_encode($subSubCat);
    }

    public function subSubCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_id' => 'required',
            'subSubCategory_name' => 'required',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。',
            'subCategory_id.required' => 'サブカテゴリーを選択してください。',
            'subSubCategory_name.required' => '孫カテゴリー名は必須です。',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subCategory_id' => $request->subCategory_id,
            'subSubCategory_name' => $request->subSubCategory_name,
            'subSubCategory_slug_name' => str_replace(' ', '-', $request->subSubCategory_name),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '孫カテゴリーを作成しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function subSubCategoryEdit($id)
    {
        if (auth()->user()->category == 1) {
            $categories = Category::orderBy('id', 'ASC')->get();
            $subCategories = SubCategory::orderBy('id', 'ASC')->get();
            $subSubCategory = SubSubCategory::findOrFail($id);

            return view('admin.shop.category.subSubCategory_edit', compact('categories', 'subCategories', 'subSubCategory'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function subSubCategoryUpdate(Request $request, $id)
    {
        $subSubCategory = SubSubCategory::findOrFail($id);
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subCategory_id' => 'required',
            'subSubCategory_name' => 'required',
        ], [
            'category_id.required' => 'メインカテゴリーを選択してください。',
            'subCategory_id.required' => 'サブカテゴリーを選択してください。',
            'subSubCategory_name.required' => '孫カテゴリー名は必須です。',
        ]);

        $subSubCategory->category_id = $request->category_id;
        $subSubCategory->subCategory_id = $request->subCategory_id;
        $subSubCategory->subSubCategory_name = $request->subSubCategory_name;
        $subSubCategory->subSubCategory_slug_name = str_replace(' ', '-', $request->subSubCategory_name);
        $subSubCategory->save();

        $notification = array(
            'message' => '孫カテゴリーID：' . $subSubCategory->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.subSubCategory')
            ->with($notification);
    }

    public function subSubCategoryDelete($id)
    {
        if (auth()->user()->category == 1) {
            $subSubCategory = SubSubCategory::findOrFail($id);
            $subSubCategory->delete();

            $notification = array(
                'message' => '孫カテゴリー：' . $subSubCategory->subSubCategory_name . 'を削除しました。',
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
}
