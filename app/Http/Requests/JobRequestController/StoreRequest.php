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
        'prefecture_id' => 'required_if:is_online,0 | nullable | between:1,47',
        'title' => 'required | string | max:30',
        'content' => 'required | string | min:30 | max:3000 ',
        'price' => 'required | integer | min:500 | max:9990000',
        'application_deadline' => 'required | date | after:yesterday',
        'required_date' => 'nullable | date | after:yesterday',
        'is_online' => 'required | boolean',
        'is_call' => 'required | boolean',
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

    /**
    * 項目名
    *
    * @return array
    */
    public function attributes()
    {
        return [
            'after:yesterday' => '昨日',
            'required_date' => '昨日',
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
