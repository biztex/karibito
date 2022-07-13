<?php

namespace App\Http\Requests\Mypage\SkillController;

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
            'name' => 'required | string | max:255',
            'year' => 'required | integer | between:1,20',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'スキル名',
            'year' => '経験年数',
        ];
    }
}
