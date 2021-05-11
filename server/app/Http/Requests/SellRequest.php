<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'item-image' => ['required', 'file', 'image'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'stock' => ['required', 'integer'],
            'ec_category' => ['required', 'integer'],
            'condition' => ['required', 'integer'],
            'payer' => ['required', 'integer'],
            'delivery' => ['required', 'integer'],
            'deliveryTime' => ['required', 'integer'],
            'price' => ['required', 'integer', 'min:100', 'max:9999999'],
        ];
    }

    public function attributes()
    {
        return [
            'item-image' => '商品画像',
            'name' => '商品名',
            'description' => '商品の説明',
            'stock' => '在庫数',
            'ec_category' => 'カテゴリ',
            'condition' => '商品の状態',
            'payer' => '配送料の負担',
            'delivery' => '配送方法',
            'deliveryTime' => '発送までの日数',
            'price' => '販売価格',
        ];
    }
}
