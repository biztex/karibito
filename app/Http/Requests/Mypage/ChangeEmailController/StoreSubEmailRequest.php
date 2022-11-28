<?php

namespace App\Http\Requests\Mypage\ChangeEmailController;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubEmailRequest extends FormRequest
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
            'sub_email' => [ 'required', 'email', 'max:255', 'unique:users' ]
        ];
    }
}
