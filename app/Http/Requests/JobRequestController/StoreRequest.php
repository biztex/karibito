<?php

namespace App\Http\Requests\JobRequestController;

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
        'category_id' => 'required | integer | exists:m_product_child_categories,id',
        'prefecture_id' => 'nullable | integer | exists:prefectures,id',
        'title' => 'required | string | max:30',
        'content' => 'required | string | min:30 | max:3000 ',
        'price' => 'required | integer | min:500 | max:9990000',
        'application_deadline' => 'required | date',
        'required_date' => 'nullable | date',
        'is_online' => 'required | integer | in:0,1',
        'is_call' => 'required | integer | in:0,1',           
        ];
    }
}
