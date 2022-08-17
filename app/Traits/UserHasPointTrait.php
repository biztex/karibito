<?php
namespace App\Traits;

use App\Models\User;
use App\Models\UserGetPoint;
use App\Models\UserUsePoint;
use Illuminate\Contracts\Database\Eloquent\Builder;

/**
 * サービスとリクエストでの検索用のトレイト
 */
trait UserHasPointTrait
{
    /**
     * ユーザーのポイント残高を表示するときに使う
     */
    public function userHasPoint()
    {
        $today = date('Y-m-d');
        $user_get_point = UserGetPoint::where([
            ['user_id', '=', \Auth::id()],
            ['deadline', '>=', $today],
        ])->get()->sum('point'); //期限切れではないポイントの合計を取得

        $user_use_point = UserUsePoint::where([
            ['user_id', '=', \Auth::id()],
            ['deleted_at', '=', null],
        ])->get()->sum('point'); //期限切れではないポイントの合計を取得

        $user_has_point = $user_get_point - $user_use_point;

        return $user_has_point;
    }

}