<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSliderRequest extends FormRequest
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
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'slider_img' => 'required|mimes:jpg,jpeg,png',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'description' => 'コンテンツ',
            'slider_img' => 'スライダー画像',
        ];
    }
}
