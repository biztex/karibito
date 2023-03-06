<?php

namespace App\Http\Requests\ChatroomController;

use Illuminate\Foundation\Http\FormRequest;

class SendNdaRequest extends FormRequest
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
            'text' => 'required|string',
            'status' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'text' => '提供価格は必ず指定してください',
            'status' => '提供価格は500円~9,990,000円で指定してください' ,
        ];
    }
}
