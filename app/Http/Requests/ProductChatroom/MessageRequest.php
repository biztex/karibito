<?php

namespace App\Http\Requests\ProductChatroom;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => 'required | max:3000'
        ];
    }

    public function messages()
    {
      return [
        'text.required' => '入力してください。',
        'text.max' => '3000文字以下で指定してください。',
      ];
    }
}
