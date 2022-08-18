<?php

namespace App\Http\Requests\UserProfile;

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

    protected function prepareForValidation()
    {
        if( $this->year == null && $this->month == null && $this->day == null) {
            $birthday = null;
        } else {
            // 年、月、日の入力からdate型の誕生日を作成
            $birthday = $this->year . '-' . $this->month . '-' . $this->day;
        }
        
        $arr_content = [];
        foreach($this['content'] as $value) {
            if($value !== null) {
                $arr_content[] = $value;
            }
        }

        $this->merge([
            'birthday' => $birthday,
            'arr_content' => $arr_content,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required | max:24 |string',
            'first_name' => 'required | max:24 | string',
            'last_name' => 'required | max:24 | string',
            'gender' => 'required | integer | in:1,2',
            'birthday' => 'nullable | date',
            'prefecture' => 'required | integer | exists:prefectures,id',
            'zip' => 'nullable | numeric | digits:7',
            'address' => 'nullable | max:255',
            'introduction' => 'nullable | max:3000 | string',
            'icon' => 'nullable | max:20480 | file | image | mimes:png,jpg',
            'cover' => 'nullable | max:20480 | file | image | mimes:png,jpg',
            'content.*' => 'max:10',
            'arr_content' => 'nullable | array | max:10'
        ];
    }
    public function messages()
    {
        return [
            'content.*.max' => '10文字以下で指定してください。',
            'arr_content.size' => '得意分野は最大で10個まで登録できます。'
        ];
    }
}
