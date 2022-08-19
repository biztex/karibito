<?php

namespace App\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\Portfolio;

class PortfolioService
{
    /**
     * 新規ポートフォリオ投稿
     */
    public function storePortfolio($request)
    {
        $portfolio = new Portfolio;
        $portfolio->user_id = \Auth::id();
        $portfolio->path =  $request->path->store('portfolio_paths', 'public');
        $portfolio->fill($request->substitutable());
        $portfolio->save();

        return $portfolio;
    }

    /**
     * 新規動画追加
     */
    public function storePortfolioLink(array $request, $id)
    {
        if (isset($request['youtube_link'])) {
            foreach ($request['youtube_link'] as $index => $value) {
                if ($request['youtube_link'][$index]){
                    $links = [
                        'youtube_link' => $request['youtube_link'][$index],
                    ];
                    $portfolio = Portfolio::find($id);
                    $portfolio->portfolioLink()->create($links);
                }
            }
        }
    }

    /**
     * ポートフォリオ編集
     */
    public function updatePortfolio($request, $portfolio)
    {
        //画像は変更時のみ保存する
        if($request->path){
            $portfolio->path =  $request->path->store('portfolio_paths', 'public');
        }
        $portfolio->fill($request->substitutable());
        $portfolio->save();

        return $portfolio;
    }

    /**
     * 動画を編集
     */
    public function updatePortfolioLink(array $request, $portfolio)
    {
        $portfolio->portfolioLink()->delete();
        if (isset($request['youtube_link'])) {
            if ($request['youtube_link'] !== null) {
                foreach ($request['youtube_link'] as $index => $value) {
                    if ($request['youtube_link'][$index]) {
                        $links = [
                            'youtube_link' => $request['youtube_link'][$index],
                        ];
                        $portfolio = Portfolio::find($portfolio->id);
                        $portfolio->portfolioLink()->create($links);
                    }
                }
            }
        }
    }


    /**
     * 詳細ページのページャー前を取得する
     */
    public function prevPage($portfolio, $portfolio_list)
    {
        // ポートフォリオが１つ以下の時は実行しない
        if(count($portfolio_list) < 1){
            return false;
        }

        foreach($portfolio_list as $i => $pf) {
            // 現在のポートフォリオの前の配列番号を取得する。最初の場合は取得しない。
            if(($portfolio->id == $pf->id) && ($pf->id != collect($portfolio_list)->first()->id)){
                $prev_page = $portfolio_list[$i - 1]->id;
                return $prev_page;
            }
        }
    }

    /**
     * 詳細ページのページャー次を取得する
     */
    public function nextPage($portfolio, $portfolio_list)
    {
        // ポートフォリオが１つ以下の時は実行しない
        if(count($portfolio_list) < 1){
            return false;
        }

        foreach($portfolio_list as $i => $pf) {
            // 現在のポートフォリオの次の配列番号を取得する。最後の場合は取得しない。
            if(($portfolio->id == $pf->id) && ($pf->id != collect($portfolio_list)->last()->id)){
                $next_page = $portfolio_list[$i + 1]->id;
                return $next_page;
            }
        }
    }
}
