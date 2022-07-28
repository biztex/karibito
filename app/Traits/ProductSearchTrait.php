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
     * 親カテゴリーが一致するものを取得するするときに使う
     */
    public function searchByParentCategory(Builder $query, int $category_id):Builder
    {
        $child_categories = MProductChildCategory::where('parent_category_id', $category_id)->pluck('id')->toArray();
        $query->whereIn('category_id', $child_categories);
    }

    /**
     * 子カテゴリが一致するものを取得するときに使う
     */
    public function searchByChildCategory(Builder $query, int $category_id):Builder
    {
        $query->where('category_id', $category_id);
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