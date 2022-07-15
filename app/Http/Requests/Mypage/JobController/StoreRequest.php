<?php

namespace App\Http\Requests\Mypage\JobController;

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
            'content' => 'max:3000',
        ];
    }

    public function attributes()
    {
        return [
            'content' => '職務',
        ];
    }
}
