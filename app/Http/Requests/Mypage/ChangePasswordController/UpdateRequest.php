<?php

namespace App\Http\Requests\Mypage\ChangePasswordController;

use App\Rules\MatchPasswordRule;
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
            'current_password'      => [
                'required',
                'string',
                new MatchPasswordRule($this->password),
            ],
            'password'              => 'required|string|min:8|max:255|confirmed',
            'password_confirmation' => 'required|string|min:8|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'current_password'      => '現在のパスワード',
            'password'              => '新しいパスワード',
            'password_confirmation' => '新しいパスワードの再入力',
        ];
    }
}
