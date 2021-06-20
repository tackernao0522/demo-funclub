<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'size' => ['string', 'nullable', 'max:200'],
            'name' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'card_name' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'size' => 'サイズ',
            'name' => 'お名前(フルネーム)',
            'zip_code' => '郵便番号',
            'address' => 'お届け先住所',
            'phone_number' => '電話番号',
            'card_name' => 'カード名義',
        ];
    }
}
