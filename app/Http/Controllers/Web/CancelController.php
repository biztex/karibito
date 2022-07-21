<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CancelController\StoreRequest;
use App\Models\Purchase;
use App\Models\PurchasedCancel;
use App\Services\ChatroomService;
use App\Services\ChatroomMessageService;
use App\Services\PurchasedCancelService;


class CancelController extends Controller
{
    private $chatroom_service;
    private $chatroom_message_service;
    private $purchased_cancel_service;

    public function __construct(ChatroomService $chatroom_service, ChatroomMessageService $chatroom_message_service, PurchasedCancelService $purchased_cancel_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->purchased_cancel_service = $purchased_cancel_service;
    }

    /**
     * キャンセル申請入力画面
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Purchase $purchase
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Request $request, Purchase $purchase)
    {
        return view('chatroom.cancel.create', compact('request','purchase'));
    }

    /**
     * キャンセル申請確認画面から入力画面へ戻る
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Purchase $purchase
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function back(Request $request, Purchase $purchase)
    {
        return view('chatroom.cancel.create', compact('request','purchase'));
    }

    /**
     * キャンセル申請入力確認画面
     * @param StoreRequest $request
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function confirm(StoreRequest $request)
    {
        return view('chatroom.cancel.confirm', compact('request'));
    }

    /**
     * キャンセル申請送信
     * @param StoreRequest $request
     * @param \App\Models\Purchase $purchase
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, Purchase $purchase)
    {
        \DB::transaction(function () use ($request, $purchase) {
            $purchased_cancel = $this->purchased_cancel_service->storePurchasedCancel($request->all(), $purchase);
            $this->chatroom_message_service->storePurchasedCancelMessage($purchased_cancel, $purchase->chatroom);
        });
        return redirect()->route('cancel.send', $purchase->id);
    }

    /**
     * キャンセル申請完了画面
     * @param \App\Models\Purchase $purchase
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function send(Purchase $purchase)
    {
        return view('chatroom.cancel.send', compact('purchase'));
    }

    /**
     * キャンセル申請内容確認画面
     * @param \App\Models\PurchasedCancel $purchased_cancel
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(PurchasedCancel $purchased_cancel)
    {
        return view('chatroom.cancel.show', compact('purchased_cancel'));
    }

    /**
     * キャンセル申請承認
     * @param \App\Models\PurchasedCancel $purchased_cancel
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function approval(PurchasedCancel $purchased_cancel)
    {
        \DB::transaction(function () use ($purchased_cancel) {
            $this->purchased_cancel_service->changeStatusComplete($purchased_cancel);
            $this->chatroom_message_service->storePurchasedCancelApprovalMessage($purchased_cancel);
            $this->chatroom_service->statusChangeCanceled($purchased_cancel->purchase->chatroom);
        });
        return redirect()->route('cancel.complete', $purchased_cancel);
    }

    /**
     * キャンセル申請承認完了画面
     * @param \App\Models\PurchasedCancel $purchased_cancel
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function complete(PurchasedCancel $purchased_cancel)
    {
        return view('chatroom.cancel.complete', compact('purchased_cancel'));
    }

    /**
     * キャンセル申請異議申し立て
     * @param \App\Models\PurchasedCancel $purchased_cancel
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function objection(PurchasedCancel $purchased_cancel)
    {
        \DB::transaction(function () use ($purchased_cancel) {
            $this->purchased_cancel_service->changeStatusObjection($purchased_cancel);
            $this->chatroom_message_service->storePurchasedCancelObjectionMessage($purchased_cancel);
        });
        return redirect()->route('chatroom.show', $purchased_cancel->purchase->chatroom_id);
    }
}
