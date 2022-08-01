<?php

namespace App\Http\Requests\SurveyController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'comment' => 'max:3000',
            'star' => 'required | integer | between:1,5',
        ];
    }

    public function messages()
    {
        return [
            'comment.max' => '評価コメントは3000文字以内で入力してください。',
            'star.required' => '必ず星を選択して評価してください。'
        ];
    }
}
