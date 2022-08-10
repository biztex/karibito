<?php

namespace App\Http\Requests\ChatroomController;

use App\Models\UserCoupon;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\PointService;
use App\Rules\UseCouponRule;

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


        if($this->coupon_use === null) {
            $coupon_number = null;
        } else {
            $coupon_number = $this->coupon_number;
        }

        if($this->point_use == 0) {
            $user_use_point = null;
        } else {
            $user_use_point = $this->user_use_point;
        }

        $this->merge([
            'exp' => $exp,
            'coupon_number' => $coupon_number,
            'user_use_point' => $user_use_point
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
        // $price = $this->proposal->price;
        $coupon_min_price = UserCoupon::where('coupon_number', $this->coupon_number)->pluck('min_price')->first(); //クーポンを利用できる最小金額
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
            'coupon_use' => 'nullable |  boolean',
            'coupon_number' => ['required_if:coupon_use,1', 'nullable', new UseCouponRule],
            'coupon_discount' => "integer | nullable",
            'point_use' => 'required |  boolean',
            'user_use_point' => "required_if:point_use,1 | integer | max:{$user_has_point} | nullable"
        ];
    }

    public function messages()
    {
        return [
            'card_id.*' => '※お支払いカードを選択してください。',
            'coupon_number.required_if' => '利用するクーポンを選択してください。' 
        ];
    }
}
