<?php

namespace App\Http\Requests\Mypage\CareerController;

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

    protected function prepareForValidation()
    {
        if($this->first_year != null && $this->first_month != null){
            $first = $this->first_year . '-' . $this->first_month;
            $this->merge(['first' => $first,]);
        }

        if($this->last_year != null && $this->last_month != null){
            $last = $this->last_year . '-' . $this->last_month;
            $this->merge(['last' => $last]);       
       }     

        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'career_name' => 'required | string | max:30',
            'first' => 'required | date',
            'last' => 'nullable | date | after_or_equal:first',
            // 'first_year' => 'required | integer | min:1970 | max:2099',
            // 'first_month' => 'required | integer | between:1,12',
            'last_year' => 'required_with:last_month',
            'last_month' => 'required_with:last_year',
        ];
    }

    public function attributes()
    {
        return [
            'career_name' => '経歴名',
            'first' => '開始年月',
            'last' => '終了年月',
            'first_year' => '開始年',
            'first_month' => '開始月',
            'last_year' => '終了年',
            'last_month' => '終了月',
        ];
    }
}
