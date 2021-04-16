<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticle extends FormRequest
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
            'item-image' => 'required|file|image',
            'primary_category' => 'required|integer',
            'post_title' => 'required|max:100',
            'post_date' => 'required|date',
            'body' => 'required|string|max:2000',
        ];
    }

    public function attributes()
    {
        return [
            'item-image' => 'ニュース画像',
            'post_title' => 'タイトル',
            'post_date' => '作成日',
            'body' => '本文',
        ];
    }
}
