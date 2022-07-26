<?php

namespace App\Http\Requests\CancelController;

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
            'reason1' => 'required_without_all:reason2,reason3,reason4,reason5,reason6',
            'text' => 'required | min:30 | max:3000'
        ];
    }

    public function attributes()
    {
        return [
            'text' => 'キャンセル理由'
        ];
    }

    public function messages() {
        return [
            'reason1.required_without_all' => '一つ以上選択してください。'
        ];
    }
}
