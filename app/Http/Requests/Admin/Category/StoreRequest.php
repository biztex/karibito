<?php

namespace App\Http\Requests\Admin\Category;

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
            'name' => 'required|string',
            'banner_image_path' => 'nullable|mimes:jpg,jpeg,png',
            'top_image_path' => 'nullable|mimes:jpg,jpeg,png',
            'other_image_path' => 'nullable|mimes:jpg,jpeg,png,svg',
            'content' => 'nullable|string'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'カテゴリー名',
            'banner_image_path' => 'バナー画像',
            'top_image_path' => 'おすすめカテゴリアイコン',
            'other_image_path' => 'サービスアイコン',
            'content' => 'カテゴリ説明'
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'name',
            'banner_image_path',
            'top_image_path',
            'other_image_path',
            'content'
        ]);
    }
}
