<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Services\PortfolioService;
use App\Http\Requests\PortfolioController\StoreRequest;
use App\Http\Requests\PortfolioController\UpdateRequest;

class PortfolioController extends Controller
{
    private $portfolio_service;

    public function __construct(PortfolioService $portfolio_service)
    {
        $this->portfolio_service = $portfolio_service;
    }

    public function index()
    {
        $portfolio_list = Portfolio::where('user_id', \Auth::id())->get();

        return view('portfolio.index', compact('portfolio_list'));
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio_list = Portfolio::where('user_id', \Auth::id())->get();
        $base_url = config('app.url');
        $url = "$base_url/portfolio/$portfolio->id";

        $prev_page = $this->portfolio_service->prevPage($portfolio, $portfolio_list);
        $next_page = $this->portfolio_service->nextPage($portfolio, $portfolio_list);

        return view('portfolio.show', compact('portfolio', 'portfolio_list', 'url', 'prev_page', 'next_page'));
    }

    public function create()
    {
        return view('portfolio.create');
    }

    public function store(StoreRequest $request)
    {
        \DB::transaction(function () use ($request) {
        $portfolio = $this->portfolio_service->storePortfolio($request);
        $this->portfolio_service->storePortfolioLink($request->all(), $portfolio->id);
        });

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを登録しました！');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(UpdateRequest $request, Portfolio $portfolio)
    {
        $this->portfolio_service->updatePortfolio($request, $portfolio);
        $this->portfolio_service->updatePortfolioLink($request->all(), $portfolio);

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを更新しました！');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->portfolioLink()->delete();
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを削除しました！');
    }
}
