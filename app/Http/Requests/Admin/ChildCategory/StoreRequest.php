<?php

namespace App\Http\Requests\Admin\ChildCategory;

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
            'parent_category_id' => 'required|integer|exists:m_product_categories,id',
            'name' => 'required|string'
        ];
    }
    public function attributes()
    {
        return [
            'parent_category_id' => '親カテゴリ名',
            'name' => 'カテゴリー名'
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'parent_category_id',
            'name'
        ]);
    }
}
