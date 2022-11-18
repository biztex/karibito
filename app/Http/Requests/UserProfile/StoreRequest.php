<?php

namespace App\Http\Requests\UserProfile;

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
            'name' => 'required | max:24 | string',
            'first_name' => 'required | max:24 | string',
            'last_name' => 'required | max:24 | string',
            'gender' => 'required | integer | in:1,2',
            'prefecture_id' => 'required | integer | exists:prefectures,id',
            'friend_code' => 'max:10 | string',
            'where_know' => 'required'
        ];
    }
}
