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
        
        // 有効期限内、かつ、有効期限が昇順の取得ポイントのコレクション
        $get_points = UserGetPoint::where([
                            ['user_id', '=', \Auth::id()],
                            ['deadline', '>=', $today],
                        ])
                        ->orderBy('deadline', 'asc')
                        ->select('point')
                        ->get();


        // 総取得ポイント 15000
        $has_point = $get_points->sum('point'); // 7000

        // 総使用ポイント 3800
        $used_point = UserUsePoint::where([
                            ['user_id', '=', \Auth::id()],
                            ['deleted_at', '=', null],
                        ])
                        ->get()
                        ->sum('point'); //期限切れではないポイントの合計を取得 2000ポイント
        
        // 古いポイントから差し引いていく
        foreach($get_points as $key => $get_point_object) {
            $get_point = $get_point_object->point;

            if ($get_point <= $used_point) {
                // used_point更新
                $used_point -= $get_point;
                // トータルポイント更新
                $has_point -= $get_point;
            }else{
                $has_point -= $used_point;
                break;
            }
        }

        return $has_point;
    }

}