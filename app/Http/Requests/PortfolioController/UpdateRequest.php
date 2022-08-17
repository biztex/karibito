<?php

namespace App\Http\Requests\PortfolioController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
            'path' => 'max:20480 | file | image | mimes:png,jpg', //画像は既に保存されているのでUpdateの場合はrequiredを削除
            'category_id' => 'required | integer | exists:m_product_child_categories,id',
            'title' => 'required | string | max:30',
            'detail' => 'required | string | max:3000 ',
            'year' => 'required | integer',
            'month' => 'required | integer',
            'youtube_link.*' => 'nullable | string | max:255 | url'
        ];
    }

    /**
     * エラー表示日本語化
     */
    public function attributes()
    {
        return [
            'path' => '画像',
            'detail' => '詳細',
        ];
    }

    public function substitutable()
    {
        return $this->only([
            'category_id',
            'title',
            'detail',
            'year',
            'month'
        ]);
    }
}
