<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index');
    }
}
