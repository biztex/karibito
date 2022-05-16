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
            'name' => 'required | max:128',
            'email' => 'required | email | unique:users,email,'.\Auth::user()->email.',email',
            'first_name' => 'required | max:128',
            'last_name' => 'required | max:128',
            'gender' => 'required',
            'prefecture_id' => 'required',
            'zip' => 'required',
            'address' => 'required | max:128',
            'introduction' => 'max:2000',
            'icon' => 'required',
            'cover' => 'required'
            
        ];
    }
}
