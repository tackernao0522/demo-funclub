<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubTitleRequest extends FormRequest
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
            'sub_title' => 'required|max:10',
            'description' => 'required|string|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'sub_title' => 'サブタイトル',
            'description' => 'サブタイトルの説明',
        ];
    }
}
