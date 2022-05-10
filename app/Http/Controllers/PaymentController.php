<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * 過去取引一覧画面を表示する
     * 
     * @return view
     */
    public function index()
    {
        return view('sample.payment_history');
    }
}
