<?php

namespace App\Http\Requests\ChatroomController;

use App\Models\UserCoupon;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\PointService;
use App\Rules\UseCouponRule;

class PaymentRequest extends FormRequest
{
    private $point_service, $coupon_service;

    public function __construct(PointService $point_service, UserCoupon $coupon_service)
    {
        $this->point_service = $point_service;
        $this->coupon_service = $coupon_service;
    }

    protected function prepareForValidation()
    {
        if( $this->immediate === null ) {
            $cc_number = null;
            $cc_name = null;
            $cvc = null;
            $exp_month = null;
            $exp_year = null;
            $exp = null;
        } else {
            $card_id = null;
            $customer_id =null;
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
        // $use_coupon_discount = $this->coupon_service->getCouponDiscount($this->coupon_number);

            return [
                'user_use_point' => "max:{$user_has_point} | nullable",
                'coupon_number' => ['nullable', new UseCouponRule],
                'card_id' => 'required_if:immediate,null | string',
                'customer_id' => 'required_if:immediate,null | string',
                'cc_number' => 'required_if:immediate,checked | nullable | digits_between:14,16',
                'cc_name' => 'required_if:immediate,checked | nullable | string | max:30',
                'cvc' => 'required_if:immediate,checked | nullable | digits_between:3,4',
                'exp_year' => 'required_if:immediate,checked | nullable ',
                'exp_month' => 'required_if:immediate,checked | nullable ',
                'exp' => 'required_if:immediate,checked | nullable | after:last month',
            ];
        }
}