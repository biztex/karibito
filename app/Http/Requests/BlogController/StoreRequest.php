<?php

namespace App\Http\Requests\BlogController;

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
            'title' => 'required|string|max:30',
            'product_id' => 'required|integer|exists:products,id',
            'content' => 'required|string'
        ];
    }

    /**
     * エラー表示日本語化
     */
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'product_id' => '出品サービス',
            'content' => '投稿内容'
        ];
    }

    public function substitutable()
    {
        return $this->only([
            'title',
            'product_id',
            'content'
        ]);
    }
}
