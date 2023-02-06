<?php

namespace App\Rules;

use App\Models\UserCoupon;
use Illuminate\Contracts\Validation\Rule;

class UseCouponRule implements Rule
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
        $useable_coupons = \Auth::user()->userCoupons;

        foreach($useable_coupons as $coupon){
            if($coupon->id === (int)$value) return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ご指定のクーポンは存在しません。';
    }
}
