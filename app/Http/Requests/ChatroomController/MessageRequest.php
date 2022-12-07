<?php

namespace App\Http\Requests\ChatroomController;

use App\Rules\phoneNumExclusion;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'text' => ['required_without_all:file_name,file_path', 'max:3000', new phoneNumExclusion],
            'file_path' => 'nullable | file | max:20480'
        ];
    }

    public function messages()
    {
      return [
        'text.required_without_all' => 'メッセージもしくは添付資料を指定してください。',
        'text.max' => '3000文字以下で指定してください。',
        'file_path.file' => '添付できる資料はファイルを指定してください。',
        'file_path.max' => '添付できる資料は20MBまでです。',
      ];
    }
}
