<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_id' => 'required',
            'category_id' => 'required',
            'subCategory_id' => 'required',
            'subSubCategory_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|string|unique: products',
            'product_qty' => 'required|integer',
            'product_tags_name' => 'required|string',
            'product_size' => 'nullable|string',
            'product_color' => 'nullable|string',
            'selling_price' => 'required|integer',
            'product_code' => 'required|string',
            'discount_price' => 'nullable|integer',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'product_thambnail' => 'image|mimes:jpg,jpeg,png,svg',
            // 'file' => 'nullable|mimes:jpeg,png,jpg,svg,zip,pdf,xlx,csv|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'brand_id' => 'ブランド',
            'category_id' => 'メインカテゴリー',
            'subCategory_id' => 'サブカテゴリー',
            'subSubCategory_id' => '孫カテゴリー',
            'product_name' => '商品名',
            'product_code' => '商品コード',
            'product_qty' => '在庫数',
            'product_tags_name' => '商品タグ',
            'product_size' => '商品サイズ',
            'product_color' => '商品カラー',
            'selling_price' => '価格',
            'discount_price' => '割引価格',
            'short_descp' => '商品説明(小見出し)',
            'long_descp' => '商品説明(メイン) ',
            'product_thambnail' => 'メインサムネイル画像 ',
            // 'file' => '製品詳細',
        ];
    }
}
