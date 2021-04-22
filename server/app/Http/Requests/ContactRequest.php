<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'your_name' => 'required|max:25',
            'your_email' => 'required|email',
            'your_message' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'your_name' => '名前',
            'your_email' => 'メールアドレス',
            'your_message' => 'メッセージ',
        ];
    }
}
