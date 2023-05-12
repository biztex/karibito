<?php

namespace App\Http\Requests\ChatroomController;

use App\Models\UserCoupon;
use App\Rules\UseCouponMinPriceRule;
use App\Rules\UseCouponRule;
use App\Services\PointService;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseConfirmRequest extends FormRequest
{

    private $point_service;

    const AVAILABLE_POINTS_THRSHOLD = 0.1;

    public function __construct(PointService $point_service)
    {
        $this->point_service = $point_service;
    }
    protected function prepareForValidation()
    {
        if($this->coupon_use === null) {
            $coupon_id = null;
        } else {
            $coupon_id = $this->coupon_id;
        }

        if($this->point_use == 0) {
            $user_use_point = null;
        } else {
            $user_use_point = $this->user_use_point;
        }

        $this->merge([
            'coupon_id' => $coupon_id,
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
        $coupon_min_price = UserCoupon::where('id', $this->coupon_id)->pluck('min_price')->first(); //クーポンを利用できる最小金額
        $user_has_point = $this->point_service->showPoint(); //ポイントの合計を取得
        $proposal_price = $this->route('proposal')->price;
        $use_point_price = $proposal_price * $this::AVAILABLE_POINTS_THRSHOLD; //ポイント利用は合計金額の10%までなので，料金の10%を取得

        return [
            'payment_type' => 'required',
            'card_id' => 'required | string',
            'stripeToken' => 'required_if:card_id,immediate| nullable | string',
            'coupon_use' => 'nullable | boolean',
            'coupon_id' => ['required_if:coupon_use,1', 'nullable', new UseCouponRule, new UseCouponMinPriceRule],
            'coupon_discount' => "integer | nullable ",
            'point_use' => 'required |  boolean',
            'user_use_point' => "required_if:point_use,1 | integer | max:{$user_has_point} | nullable | lte:{$use_point_price}"
        ];
    }

    public function messages()
    {
        return [
            'card_id.*' => '※お支払いカードを選択してください。',
            'coupon_id.required_if' => '利用するクーポンを選択してください。' ,
            'stripeToken.*' => '※カード情報を正しく入力してください。'
        ];
    }
}
