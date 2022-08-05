<?php

namespace App\Http\Requests\PaymentController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    protected function prepareForValidation()
    {
       $exp = $this->exp_year . '-' . $this->exp_month;       

        $this->merge([
            'exp' => $exp,
        ]);
    }

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
            'cc_name' => 'required | string | max:30',
            'cc_number' => 'required | digits_between:14,16',
            'exp' => 'required | after:last month',
            'cvc' => 'required | digits_between:3,4'            
        ];
    }
}
