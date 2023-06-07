<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CancelController\StoreRequest;
use App\Models\Purchase;
use App\Models\PurchasedCancel;
use App\Models\UserUsePoint;
use App\Services\ChatroomService;
use App\Services\ChatroomMessageService;
use App\Services\PurchasedCancelService;
use App\Services\PurchaseService;
use App\Services\PaymentService;
use App\Services\CouponService;
use App\Services\PointService;
use App\Services\UserNotificationService;

class CancelController extends Controller
{
    private $chatroom_service;
    private $chatroom_message_service;
    private $purchased_cancel_service;
    private $purchase_service;
    private $coupon_service;
    private $user_use_point_service;
    private readonly PaymentService $payment_service;

    public function __construct(ChatroomService $chatroom_service, ChatroomMessageService $chatroom_message_service, PurchasedCancelService $purchased_cancel_service, PurchaseService $purchase_service, CouponService $coupon_service, PointService $user_use_point_service, PaymentService $payment_service, UserNotificationService $userNotificationService)
    {
        $this->chatroom_service = $chatroom_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->purchased_cancel_service = $purchased_cancel_service;
        $this->purchase_service = $purchase_service;
        $this->coupon_service = $coupon_service;
        $this->user_use_point_service = $user_use_point_service;
        $this->payment_service = $payment_service;
        $this->userNotificationService = $userNotificationService;
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
    public function confirm(StoreRequest $request, Purchase $purchase)
    {
        return view('chatroom.cancel.confirm', compact('request', 'purchase'));
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
        $purchased_cancel = \DB::transaction(function () use ($request, $purchase) {
            $purchased_cancel = $this->purchased_cancel_service->storePurchasedCancel($request->all(), $purchase);
            $this->chatroom_service->statusChangeCancelReport($purchase->chatroom);
            $this->chatroom_message_service->storePurchasedCancelMessage($purchased_cancel, $purchase->chatroom);
            $this->userNotificationService->storeUserNotificationMessage($purchase->chatroom);
            return $purchased_cancel;
        });
        return redirect()->route('cancel.send', $purchased_cancel->id);
    }

    /**
     * キャンセル申請完了画面
     * @param \App\Models\Purchase $purchase
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function send(PurchasedCancel $purchased_cancel)
    {
        return view('chatroom.cancel.send', compact('purchased_cancel'));
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
        $this->coupon_service->cancelCoupon($purchased_cancel->purchase->userCoupon);
        $this->user_use_point_service->cancelPoint($purchased_cancel->purchase->userUsePoint);
        $payment = $purchased_cancel->purchase->payment;
        $this->purchased_cancel_service->purchasedCancelComplete($purchased_cancel, $payment);
        $this->userNotificationService->storeUserNotificationMessage($purchased_cancel->purchase->chatroom);
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
            $this->chatroom_service->statusChangeWork($purchased_cancel->purchase->chatroom);
            $this->chatroom_message_service->storePurchasedCancelObjectionMessage($purchased_cancel);
            $this->userNotificationService->storeUserNotificationMessage($purchased_cancel->purchase->chatroom);
        });
        return redirect()->route('chatroom.show', $purchased_cancel->purchase->chatroom_id);
    }

    /**
     * back / confirm にgetでアクセスされたときチャットルームに飛ばす
     * @param \App\Models\PurchasedCancel $purchased_cancel
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function backChatroom(Purchase $purchase)
    {
        return redirect()->route('chatroom.show', $purchase->chatroom->id);
    }
}
