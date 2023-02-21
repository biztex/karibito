<?php

namespace App\Http\Requests\JobRequestController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
        'category_id' => 'required | integer | exists:m_product_child_categories,id',
        'prefecture_id' => 'required_if:is_online,0,2 | nullable | between:1,47',
        'title' => 'required | string | max:30',
        'content' => 'required | string | min:30 | max:3000 ',
        'price' => 'required | integer | min:500 | max:9990000',
        'application_deadline' => 'required | date | after_or_equal:tomorrow', //応募期限
        'required_date' => 'nullable | date | after_or_equal:application_deadline', // 納期希望日
        'is_online' => 'required | in:0,1,2',
        // 'is_call' => 'required | boolean',　電話対応は仕様変更によって一旦非表示
        ];
    }

    /**
     * @Override
     * 勝手にリダイレクトさせない
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     */
    protected function failedValidation(Validator $validator)
    {
        //
    }

    public function messages()
    {
        return [
            'application_deadline.after_or_equal' => '応募期限には、明日以降の日付を指定してください。',
        ];
    }

    /**
     * バリデータを取得する
     * @return  \Illuminate\Contracts\Validation\Validator  $validator
     */
    public function getValidator()
    {
        return $this->validator;
    }
}
