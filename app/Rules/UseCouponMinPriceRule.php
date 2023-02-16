<?php

namespace App\Rules;

use App\Models\UserCoupon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;

class UseCouponMinPriceRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $coupon_min_price = UserCoupon::where('id', $value)->first()->min_price; //クーポンを利用できる最小金額
        $proposal_price = Request::route('proposal')->price; //合計金額
        $validate = $coupon_min_price < $proposal_price ? true : false; //最低利用金額を上回っているかどうか
        
        return $validate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ご指定のクーポンの最低利用金額が合計金額以上のため利用できません。';
    }
}
