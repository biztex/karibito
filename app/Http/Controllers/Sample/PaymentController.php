<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;
use App\Services\Sample\PaymentService;
use Illuminate\Http\Request;

/**
 * 決済のサンプルコード
 */
class PaymentController extends Controller
{

    private readonly PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * 決済の実行
     * @param Request $request
     * @return void
     */
    public function createCharge(Request $request)
    {
        $this->paymentService->createCharge($request->all());
    }

    /**
     * クレカ登録
     * @param Request $request
     * @return void
     */
    public function createCard(Request $request)
    {;
        $this->paymentService->createCard($request->all());
    }

    /**
     * クレカ一覧取得
     * @return void
     */
    public function getCardList()
    {
        $cards = $this->paymentService->getCardList();
        dump($cards);
    }
}
