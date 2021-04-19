<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BigImageRequest extends FormRequest
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
            'info_big_image_name' => 'file|image',
            'description' => 'required|string|max:2000',
        ];
    }

    public function attributes()
    {
        return [
            'info_big_image_name' => 'メイン画像',
            'description' => '説明文',
        ];
    }
}
