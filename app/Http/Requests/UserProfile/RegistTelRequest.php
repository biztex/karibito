<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

class RegistTelRequest extends FormRequest
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
            'tel' => 'regex:/\A0[0-9]{9,12}$/', // １桁目を0に指定＋0~9の数字9~12桁。１桁目を足すと10~13桁になる。
        ];
    }
}
