<?php

namespace App\Http\Requests\ProductController;

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
            'is_online' => 'required | boolean',
            'number_of_day' => 'required | integer | between:1,730',
            'time_unit' => 'required | integer',
            // 'is_call' => 'required | boolean',　電話対応は仕様変更によって一旦非表示
            'number_of_sale' => 'required | integer',
            'status' => 'required | integer',
            'option_name.*' => 'nullable | string | max:400',
            'option_price.*' => 'nullable | integer',
            'option_is_public.*' => 'integer',
            'question_title.*' => 'required_unless:answer.*,null| max:400',
            'answer.*' => 'required_unless:question_title.*,null| max:400',
            'youtube_link.*' => 'nullable | string | max:255 | url',
            'base64_text.0' => 'required',
            'paths.*' => 'max:20480 | file | image | mimes:png,jpg'
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
     * バリデータを取得する
     * @return  \Illuminate\Contracts\Validation\Validator  $validator
     */
    public function getValidator()
    {
        return $this->validator;
    }
}
