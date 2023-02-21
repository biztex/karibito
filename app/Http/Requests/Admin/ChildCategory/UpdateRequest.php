<?php

namespace App\Http\Requests\Admin\ChildCategory;

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
            'parent_category_id' => 'required|integer|exists:m_product_categories,id',
            'name' => 'required|string',
            'index_image_path' => 'nullable|mimes:jpg,jpeg,png'
        ];
    }
    public function attributes()
    {
        return [
            'parent_category_id' => '親カテゴリ名',
            'name' => 'カテゴリー名',
            'index_image_path' => 'カテゴリアイコン'
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'parent_category_id',
            'name',
            'index_image_path'
        ]);
    }
}
