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
}
