<?php

namespace App\Http\Requests\ChatroomController;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\PointService;

class PurchaseConfirmRequest extends FormRequest
{

    private $point_service;

    public function __construct(PointService $point_service)
    {
        $this->point_service = $point_service;
    }
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
        $user_has_point = $this->point_service->showPoint(); //ポイントの合計を取得

        return [
            'payment_type' => 'required',
            'card_id' => 'required | string',
            'cc_number' => 'required_if:card_id,immediate | nullable | digits_between:14,16',
            'cc_name' => 'required_if:card_id,immediate | nullable | string | max:30',
            'cvc' => 'required_if:card_id,immediate | nullable | digits_between:3,4',
            'exp_year' => 'required_if:card_id,immediate | nullable ',
            'exp_month' => 'required_if:card_id,immediate | nullable ',
            'exp' => 'required_if:card_id,immediate | nullable | after:last month',
            'amount' => 'required | integer | min:500 | max:9990000',
            'point_use' => 'required',
            'user_use_point' => "required_if:point_use,1 | integer | max:{$user_has_point} | nullable"
        ];
    }

    public function messages()
    {
        return [
            'card_id.*' => '※お支払いカードを選択してください。'
        ];
    }
}
