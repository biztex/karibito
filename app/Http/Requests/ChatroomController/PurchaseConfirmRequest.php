<?php

namespace App\Http\Requests\ChatroomController;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseConfirmRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if( $this->card_id !== 'immediate' ) {
            $exp = null;
        } else {
            $exp = $this->exp_year . '-' . $this->exp_month; 
        }      

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
            'payment_type' => 'required',
            'card_id' => 'required | string',
            'cc_number' => 'required_if:card_id,immediate | nullable | digits_between:14,16',
            'cc_name' => 'required_if:card_id,immediate | nullable | string | max:30',
            'cvc' => 'required_if:card_id,immediate | nullable | digits_between:3,4',
            'exp_year' => 'required_if:card_id,immediate | nullable ',
            'exp_month' => 'required_if:card_id,immediate | nullable ',
            'exp' => 'required_if:card_id,immediate | nullable | after:last month',
            'amount' => 'required | integer | min:500 | max:9990000'
        ];
    }

    public function messages()
    {
        return [
            'card_id.*' => '※お支払いカードを選択してください。'
        ];
    }
}
