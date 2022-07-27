<?php
namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

/**
 * サービスとリクエストでの検索用のトレイト
 */
trait ProductSearchTrait
{
    /**
     * キーワードで検索するときに使う
     */
    public function searchByKeyword(Builder $query, string $keyword):Builder
    {
        return $query->where(function(Builder $query) use($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        });
    }

    /**
     * 年代で検索するときに使う
     */
    public function searchByAgePeriod(Builder $query, int $age_period):Builder
    {
        $now_year = date('Y');
        $year = $now_year - 9;
        $year -= $age_period * 10;
        $up_year = $year + 10;

        if ($age_period == 1) {
            return $query->whereHas('user.userProfile', function (Builder $query) use($year){
                $query->whereYear('birthday', '>', $year);
            }); //要注意
        }
        elseif($age_period == 7)
        {
            return $query->whereHas('user.userProfile', function (Builder $query) use($up_year){
                $query->whereYear('birthday', '<=', $up_year);
            });
        }
        else
        {
            return $query->whereHas('user.userProfile', function (Builder $query) use($year, $up_year){
                $query->whereYear('birthday', '>', $year);
                $query->whereYear('birthday', '<', $up_year);
            });
        }
    }
}