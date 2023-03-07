<?php

namespace App\Http\Requests\ChatroomController;

use Illuminate\Foundation\Http\FormRequest;

class EditOrConclusionNdaRequest extends FormRequest
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
            'status' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'text' => 'NDAは必ず入力してください',
            'status' => 'statusは必ず入力してください',
        ];
    }
}
