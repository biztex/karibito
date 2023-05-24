<?php

namespace App\Http\Requests\WithdrawController;

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
            'agree_not_cancel' => ['required'],
            'agree_not_in_the_middle' => [ 'required'],
            'withdraw_reason' => [ 'required', 'string', 'max:255' ]
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'agree_not_cancel.required' => '退会するためには上記事項に同意する必要があります。',
            'agree_not_in_the_middle.required' => '退会するためには条件を満たす必要があります。',
        ];
    }
}
