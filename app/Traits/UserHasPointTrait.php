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
        
        // 有効期限が昇順の取得ポイントのコレクション
        $safe_points = UserGetPoint::where([
                            ['user_id', '=', \Auth::id()],
                        ])
                        ->orderBy('deadline', 'asc')
                        ->select('point')
                        ->get();


        // 総取得ポイント
        $has_point = $safe_points->sum('point');

        // 総使用済みポイント
        $used_point = UserUsePoint::where([
                            ['user_id', '=', \Auth::id()],
                            ['deleted_at', '=', null],
                        ])
                        ->get()
                        ->sum('point'); //期限切れではないポイントの合計を取得
        
        // 有効期限が古いポイントから差し引いていく
        foreach($safe_points as $most_old_object) {
            $most_old_point = $most_old_object->point;
            // もっとも古いポイントよりも総使用済みポイントが大きければ
            if ($most_old_point <= $used_point) {
                // 古いポイントの分、used_pointを小さく
                $used_point -= $most_old_point;
                // 古いポイントの分、総ポイントを小さく
                $has_point -= $most_old_point;
            }else{
                $has_point -= $used_point;
                break;
            }
        }

        return $has_point;
    }

}