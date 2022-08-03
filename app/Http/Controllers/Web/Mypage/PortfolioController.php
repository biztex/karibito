<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Services\PortfolioService;
use App\Http\Requests\PortfolioController\StoreRequest;

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

    public function create()
    {
        return view('portfolio.create');
    }

    public function store(StoreRequest $request)
    {
        $this->portfolio_service->storePortfolio($request);

        return redirect()->route('portfolio.index')->with('flash_msg', 'ポートフォリオを登録しました！');
    }
}
