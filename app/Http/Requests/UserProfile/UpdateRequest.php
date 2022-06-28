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
        // 年、月、日の入力からdate型の誕生日を作成
        $birthday = $this->year . '-' . $this->month . '-' . $this->day;

        $this->merge([
            'birthday' => $birthday,
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
            'birthday' => 'required | date',
            'prefecture' => 'required | integer | exists:prefectures,id',
            'zip' => 'nullable | numeric | digits:7',
            'address' => 'nullable | max:255',
            'introduction' => 'nullable | max:3000 | string',
            'icon' => 'nullable | max:20480 | file | image | mimes:png,jpg',
            'cover' => 'nullable | max:20480 | file | image | mimes:png,jpg'
        ];
    }
}
