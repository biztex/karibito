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
        $portfolios = Portfolio::where('user_id', \Auth::id())->get();

        return view('portfolio.index', compact('portfolios'));
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio_list = Portfolio::where('user_id', \Auth::id())->get();
        $base_url = config('app.url');
        $url = "$base_url/portfolio/$portfolio->id";

        return view('portfolio.show', compact('portfolio', 'portfolio_list', 'url'));
    }

    public function create()
    {
        return view('portfolio.create');
    }

    public function store(StoreRequest $request)
    {
        $this->portfolio_service->storePortfolio($request);

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを登録しました！');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(UpdateRequest $request, Portfolio $portfolio)
    {
        $this->portfolio_service->updatePortfolio($request, $portfolio);

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを更新しました！');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを削除しました！');
    }
}
