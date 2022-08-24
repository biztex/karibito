<?php

namespace App\Http\Requests\ChatroomController;

use Illuminate\Foundation\Http\FormRequest;

class ProposalRequest extends FormRequest
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
            'price' => 'required | integer | min:500 | max:9990000',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => '提供価格は必ず指定してください',
            'price.integer' => '提供価格は500円~9,990,000円で指定してください' ,
            'price.min' => '提供価格は500円~9,990,000円で指定してください' ,
            'price.max' => '提供価格は500円~9,990,000円で指定してください' ,
        ];
    }
}
