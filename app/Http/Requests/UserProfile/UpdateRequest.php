<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required | max:24 |string',
            'first_name' => 'required | max:24 | string',
            'last_name' => 'required | max:24 | string',
            'gender' => 'required | integer',
            'year' => 'required | integer',
            'month' => 'required | integer',
            'day' => 'required | integer',
            'prefecture' => 'required | integer',
            'zip' => 'required | numeric | digits:7',
            'address' => 'required | max:255',
            'introduction' => 'nullable | max:3000 | string',
            'icon' => 'nullable | max:20480 | file | mimes:png,jpg',
            'cover' => 'nullable | max:20480 | file | mimes:png,jpg'
        ];
    }
}
