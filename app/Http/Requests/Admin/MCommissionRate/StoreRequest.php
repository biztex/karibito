<?php

namespace App\Http\Requests\Admin\MCommissionRate;

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
            'rate' => 'required | integer | min:0 | max:100',
        ];
    }
    public function attributes()
    {
        return [
            'rate' => '手数料',
        ];
    }
}
