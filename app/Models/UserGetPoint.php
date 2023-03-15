<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGetPoint extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    /**
     * 対象のクーポンが付与されているかを確認
     *
     * @param int $user_id
     * @param string $coupon_name
     * @return UserGetPoint|null
     */
    public static function grantCoupon(int $user_id, string $coupon_name): UserGetPoint|null
    {
        return UserGetPoint::where([
            'user_id' => $user_id,
            'name' => $coupon_name
        ])->first();
    }
}
