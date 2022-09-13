<?php

namespace App\Http\Requests\BankAccountController;

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
            'bank_name' => 'required | string | max:30',
            'bank_code' => 'required | numeric | digits:4',
            'branch_name' => 'required | string | max:30',
            'branch_code' => 'required | numeric | digits:3',
            'type' => 'required | integer | in:1,2',
            'bank_account_name' => 'required | string | max:30 | regex:/\A[ァ-ヴー]+\z/u', // 全角カタカナ
            'bank_account_number' => ['required' ,'regex:/^[1-9][0-9]{1,6}$/u']
        ];
    }

    public function attributes()
    {
        return [
            'bank_name'   => '金融名',
            'bank_code'   => '金融コード',
            'branch_name' => '支店名',
            'branch_code' => '支店コード',
            'type'        => '口座種別',
            'bank_account_name'        => '口座名義',
            'bank_account_number'      => '口座番号',
        ];
    }

    public function messages()
    {
        return [
            'bank_account_name.*' => '口座名義は全角カタカナ(スペースなし)でご入力ください'
        ];
    }
}