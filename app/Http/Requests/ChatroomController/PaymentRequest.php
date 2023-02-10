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
                'coupon_id' => ['nullable', new UseCouponRule],
                'card_id' => 'required | string'
            ];
        }
}