<?php

namespace App\Http\Requests\JobRequestController;

use Illuminate\Foundation\Http\FormRequest;

class DraftRequest extends FormRequest
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
            'category_id' => 'required_without_all:title,content | nullable | integer | exists:m_product_child_categories,id',
            'prefecture_id' => 'nullable | integer | between:1,47',
            'title' => 'nullable | string | max:30',
            'content' => 'nullable | string | max:3000 ',
            'price' => 'nullable | integer | min:500 | max:9990000',
            'application_deadline' => 'nullable | date | after_or_equal:tomorrow',
            'required_date' => 'nullable | date | after_or_equal:application_deadline',
            'is_online' => 'nullable | integer | boolean',
            'is_call' => 'nullable | integer | boolean',           
        ];
    }

    public function messages()
    {
        return [
            'category_id.required_without_all' => 'カテゴリ / 商品名 / 商品の詳細 の中で1個以上の項目を必ず入力してください。',
        ];
    }
}