<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopTitleRequest extends FormRequest
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
            'main_title' => 'required|string|max:25',
            'content' => 'required|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'main_title' => 'タイトル',
            'content' => 'コンテンツ',
        ];
    }
}
