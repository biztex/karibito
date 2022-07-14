<?php

namespace App\Http\Requests\Mypage\CareerController;

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
            'first_year' => 'required | integer | min:1970 | max:2099',
            'first_month' => 'required | integer | between:1,12',
            'last_year' => 'required_with:last_month| nullable | integer | min:1970 | max:2099',
            'last_month' => 'required_with:last_year| nullable | integer | between:1,12',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '経歴名',
            'first_year' => '開始の年',
            'first_month' => '開始の月',
            'last_year' => '終了の年',
            'last_month' => '終了の月',
        ];
    }
}
