<?php

namespace App\Http\Requests\ChatroomController;

use Illuminate\Foundation\Http\FormRequest;

class CancelEvaluationRequest extends FormRequest
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
            'checkbox' => 'required',
            'star' => 'required',
            'text' => 'required | max:255 | string'
        ];
    }

    public function attributes()
    {
      return [
            'star' => '評価',
            'text' => '評価のコメント'
        ];
    }

    public function messages()
    {
      return [
            'checkbox.required' => 'キャンセル完了を確認しチェックしてください',
        ];
    }
}
