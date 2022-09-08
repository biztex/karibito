<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    private readonly StripeService $stripe_service;

    public function __construct(StripeService $stripe_service)
    {
        $this->stripe_service = $stripe_service;
    }

    /**
     * クレカ一覧・登録・削除画面
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $cards = $this->stripe_service->getCardList();

        return view('setting.card', compact('cards'));
    }

    /**
     * クレカ登録
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $token = $request->stripeToken;
        if ($token) {
            $this->stripe_service->createCard($token);
            
        } else {
            return back();
        }

        return back()->with("flash_msg", "カード情報の登録が完了しました。");
    }

    /**
     * クレカ削除
     * @param $card_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($card_id)
    {
        \DB::transaction(function () use ($card_id) {
            $this->stripe_service->destroyCard($card_id);

            \Session::put('flash_msg','クレジットカード情報を削除しました！');

        });
        return redirect()->route('setting.card.create');
    }
}
