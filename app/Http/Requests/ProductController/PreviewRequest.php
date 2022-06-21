<?php

namespace App\Http\Requests\ProductController;

use Illuminate\Foundation\Http\FormRequest;

class PreviewRequest extends FormRequest
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
            'category_id' => 'nullable | integer | exists:m_product_child_categories,id',
            'prefecture_id' => 'nullable | integer | between:1,47',
            'title' => 'nullable | string | max:30',
            'content' => 'nullable | string | min:30 | max:3000 ',
            'price' => 'nullable | integer | min:500 | max:9990000',
            'is_online' => 'nullable | boolean',
            'number_of_day' => 'nullable | integer',
            'is_call' => 'nullable | boolean',
            'number_of_sale' => ' nullable | integer',
        ];
    }
}
