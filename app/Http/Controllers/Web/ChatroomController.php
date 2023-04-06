<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatroomController\CancelEvaluationRequest;
use App\Http\Requests\ChatroomController\EditOrConclusionNdaRequest;
use App\Models\Chatroom;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\Proposal;
use App\Models\KaribitoSurvey;
use App\Services\ChatroomService;
use App\Services\ChatroomMessageService;
use App\Services\ProposalService;
use App\Services\PurchaseService;
use App\Services\EvaluationService;
use App\Services\StripeService;
use App\Services\PointService;
use App\Services\UserNotificationService;
use App\Services\CouponService;
use App\Http\Requests\ChatroomController\MessageRequest;
use App\Http\Requests\ChatroomController\ProposalRequest;
use App\Http\Requests\ChatroomController\EvaluationRequest;
use App\Http\Requests\ChatroomController\PurchaseConfirmRequest;
use App\Http\Requests\ChatroomController\PaymentRequest;
use App\Http\Requests\ChatroomController\SendNdaRequest;
use App\Http\Requests\ChatroomController\UpdateTrashFlgRequest;
use App\Models\ChatroomNdaMessage;
use App\Models\MPoint;
use App\Services\ChatroomNdaMessageService;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\RedirectResponse;

class ChatroomController extends Controller
{
    private $chatroom_service;
    private $chatroom_message_service;
    private $proposal_service;
    private $purchase_service;
    private $evaluation_service;
    private $point_service;
    private $coupon_service;
    private $user_notification_service;
    private $chatroom_nda_message_service;

    private readonly StripeService $stripe_service;

    public function __construct(
        ChatroomService $chatroom_service,
        ChatroomMessageService $chatroom_message_service,
        ProposalService $proposal_service,
        PurchaseService $purchase_service,
        EvaluationService $evaluation_service,
        PointService $point_service,
        CouponService $coupon_service,
        UserNotificationService $user_notification_service,
        StripeService $stripe_service,
        ChatroomNdaMessageService $chatroom_nda_message_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->proposal_service = $proposal_service;
        $this->purchase_service = $purchase_service;
        $this->evaluation_service = $evaluation_service;
        $this->stripe_service = $stripe_service;
        $this->point_service = $point_service;
        $this->coupon_service = $coupon_service;
        $this->user_notification_service = $user_notification_service;
        $this->chatroom_nda_message_service = $chatroom_nda_message_service;
    }

    /**
     * やりとり一覧画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $buyer_chatrooms = Chatroom::buyerChatroom()->orderBy('updated_at','desc')->paginate(10);
        $seller_chatrooms = Chatroom::sellerChatroom()->orderBy('updated_at','desc')->paginate(10);

        return view('chatroom.index', compact('buyer_chatrooms','seller_chatrooms'));
    }

    /**
     * やりとり一覧画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buyer()
    {
        $buyer_chatrooms = Chatroom::buyerChatroom()->orderBy('updated_at','desc')->paginate(10);
        $seller_chatrooms = Chatroom::sellerChatroom()->orderBy('updated_at','desc')->paginate(10);

        return view('chatroom.buyer', compact('buyer_chatrooms','seller_chatrooms'));
    }

    /**
     * やりとり進行中一覧画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function active()
    {
        $active_product_chatrooms = Chatroom::active()->product()->orderBy('created_at','desc')->paginate(10);
        $active_job_request_chatrooms = Chatroom::active()->jobRequest()->orderBy('created_at','desc')->paginate(10);

        return view('mypage.chatroom.active', compact('active_product_chatrooms','active_job_request_chatrooms'));
    }

    /**
     * やりとり進行中一覧画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function inactive()
    {
        $inactive_product_chatrooms = Chatroom::inActive()->product()->orderBy('created_at','desc')->paginate(10);
        $inactive_job_request_chatrooms = Chatroom::inActive()->jobRequest()->orderBy('created_at','desc')->paginate(10);

        return view('mypage.chatroom.inactive', compact('inactive_product_chatrooms','inactive_job_request_chatrooms'));
    }

    /**
     * 提供から交渉する画面
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function newProduct(Product $product)
    {
        $service = $product;
        $service_type = 'Product';
        return view('chatroom.create', compact('service', 'service_type'));
    }

    /**
     * リクエストから交渉する画面
     * @param \App\Models\JobRequest $job_request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function newJobRequest(JobRequest $job_request)
    {
        $service = $job_request;
        $service_type = 'JobRequest';
        return view('chatroom.create', compact('service', 'service_type'));
    }

    /**
     * 提供から交渉メッセージ送信でチャットルーム作成
     * @param MessageRequest $request
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function createProduct(MessageRequest $request, Product $product)
    {
        $chatroom = \DB::transaction(function () use ($request, $product) {
            $chatroom = $this->chatroom_service->startChatroomProduct($product);
            if (!$request->has('nda')) {
                // 通常のメッセージ作成
                $this->chatroom_message_service->storeNormalMessage($request->all(), $chatroom);
            } else {
                // NDAメッセージの作成
                $nda_message = $this->chatroom_nda_message_service->storeNdaMessage($request->input('text'), $chatroom);
                // NDAを送信した旨のメッセージ作成
                $this->chatroom_message_service->storeNdaMessage($nda_message, 'NDAを送信しました！');
            }
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
            
            return $chatroom;
        });
        return redirect()->route('chatroom.show', $chatroom->id);
    }

    /**
     * リクエストから交渉メッセージ送信でチャットルーム作成
     * @param MessageRequest $request
     * @param \App\Models\JobRequest $job_request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function createJobRequest(MessageRequest $request, JobRequest $job_request)
    {
        $chatroom = \DB::transaction(function () use ($request, $job_request) {
            $chatroom = $this->chatroom_service->startChatroomJobRequest($job_request);
            if (!$request->has('nda')) {
                // 通常のメッセージ作成
                $this->chatroom_message_service->storeNormalMessage($request->all(), $chatroom);
            } else {
                // NDAメッセージの作成
                $nda_message = $this->chatroom_nda_message_service->storeNdaMessage($request->input('text'), $chatroom);
                // NDAを送信した旨のメッセージ作成
                $this->chatroom_message_service->storeNdaMessage($nda_message, 'NDAを送信しました！');
            }
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
            
            return $chatroom;
        });
        return redirect()->route('chatroom.show', $chatroom->id);
    }

    /**
     * チャットルーム画面
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Chatroom $chatroom)
    {
        if($chatroom->seller_user_id === \Auth::id()){
            $partner = $chatroom->buyerUser;
        } else {
            $partner = $chatroom->sellerUser;
        }

        $this->chatroom_message_service->isView($chatroom);

        return view('chatroom.show', compact('chatroom', 'partner'));
    }

    /**
     * 通常メッセージ送信
     * @param MessageRequest $request
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function message(MessageRequest $request, Chatroom $chatroom)
    {
        $this->chatroom_message_service->storeNormalMessage($request->all(), $chatroom);
        $this->user_notification_service->storeUserNotificationMessage($chatroom);

        return back();
    }

    /**
     * NDA送信
     * 
     * @param SendNdaRequest $request
     * @param Chatroom $chatroom
     * @return RedirectResponse
     */
    public function sendNda(SendNdaRequest $request, Chatroom $chatroom): RedirectResponse
    {
        // NDAメッセージの作成
        $nda_message = $this->chatroom_nda_message_service->storeNdaMessage($request->input('text'), $chatroom);
        // NDAを送信した旨のメッセージ作成
        $this->chatroom_message_service->storeNdaMessage($nda_message, 'NDAを送信しました！');
        // 送信通知作成
        $this->user_notification_service->storeUserNotificationMessage($chatroom);

        return back();
    }

    /**
     * NDA編集・締結
     * 
     * @param EditOrConclusionNdaRequest $request
     * @param Chatroom $chatroom
     * @return RedirectResponse
     */
    public function editOrConclusionNda(EditOrConclusionNdaRequest $request, Chatroom $chatroom): RedirectResponse
    {
        // NDAメッセージの編集・更新
        $nda_message = $this->chatroom_nda_message_service->updateNdaMessage($request->all(), $chatroom);
        // NDAが送信・締結された旨のメッセージ作成
        if ((int)$request->input('status') === ChatroomNdaMessage::CONCLUSION) {
            $this->chatroom_message_service->storeNdaMessage($nda_message, 'NDAが締結しました！');
        } else {
            $this->chatroom_message_service->storeNdaMessage($nda_message, 'NDAを送信しました！');
        }
        // 送信通知作成
        $this->user_notification_service->storeUserNotificationMessage($chatroom);

        return back();
    }

    /**
     * NDAのPDFダウンロード
     * 
     * @param Chatroom $chatroom
     */
    public function downloadNda(Chatroom $chatroom)
    {
        $nda_text = nl2br($chatroom->chatroomNdaMessages()->latest()->first()->text);
        $pdf = \PDF::loadView('chatroom/message/nda_pdf', compact('nda_text'));
        return $pdf->download('nda.pdf');
    }


    /**
     * 提案
     * @param  ProposalRequest $request
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function proposal(ProposalRequest $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $proposal = $this->proposal_service->storeProposal($request->all(), $chatroom);
            $this->chatroom_message_service->storeProposalMessage($proposal, $chatroom);
            $this->chatroom_service->statusChangeContract($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });

        return redirect()->route('chatroom.getProposal', $chatroom);
    }

    public function getProposal(Chatroom $chatroom){ return redirect()->route('chatroom.show', $chatroom); }

    /**
     * 購入画面
     * @param \App\Models\Proposal $proposal
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchase(Proposal $proposal)
    {
        $cards = $this->stripe_service->getCardList();
        $user_has_point = $this->point_service->showPoint(); //ポイントの合計を取得
        $user_has_coupons = $this->coupon_service->showCoupon(); //期限が切れていないクーポンを取得
        $commission = $this->purchase_service->getCommission($proposal);

        return view('chatroom.purchase.create',compact('proposal', 'cards', 'user_has_coupons', 'user_has_point', 'commission'));
    }

    /**
     * 購入確認画面
     * @param PurchaseConfirmRequest $request
     * @param \App\Models\Proposal $proposal
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchaseConfirm(PurchaseConfirmRequest $request, Proposal $proposal)
    {
        $stripe_token = $this->stripe_service->checkToken($request->all());

        // カード保存、かつ新しいカードが選択されているとき
        if (isset($request['is_credit_save']) && $request['card_id'] === 'immediate') {
            $this->stripe_service->createCard($stripe_token);
            \Session::put('flash_msg', 'クレジットカードの情報を保存しました。');
        }
        
        $card = $this->stripe_service->getCard($request->all());
        $amount = $this->purchase_service->getConfirmAmount($proposal, $request->all());

        return view('chatroom.purchase.confirm',compact('request', 'proposal','stripe_token', 'card', 'amount'));
    }

    /**
     * 購入完了
     * @param PaymentRequest $request
     * @param \App\Models\Proposal $proposal
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchased(PaymentRequest $request, Proposal $proposal)
    {
            \DB::beginTransaction();

            // 金額取得
            $amount = $this->purchase_service->getFinalAmount($proposal, $request->all());
            // stripe支払い処理
            $charge_id = $this->stripe_service->createCheckout($request->all(), $amount['total']);
            if(gettype($charge_id) === 'array') {
                \DB::rollBack();
                return to_route('chatroom.purchase', $proposal)->with('flash_msg', 'カードエラーが起きました。');
            }
            
            // couponを消化する
            $user_coupon = $this->coupon_service->usedCoupon($request->coupon_id);
            // pointを消化する
            $user_use_point = $this->point_service->usedPoint($proposal->chatroom, $amount['use_point']);
            // 購入完了処理
            $this->purchase_service->purchased($charge_id, $amount['total'], $proposal, $user_coupon, $user_use_point);
            // 購入物作成
            $this->purchase_service->savePurchasedProduct($proposal);
            $chatroom = $proposal->chatroom;
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
            \DB::commit();

        return view('chatroom.purchase.complete', compact('proposal'));
    }

    /**
     * 作業完了
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(Chatroom $chatroom)
    {
        \DB::transaction(function () use ($chatroom) {
            $this->chatroom_message_service->storeCompleteMessage($chatroom);
            $this->chatroom_service->statusChangeBuyerEvaluation($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });
        return back();
    }

    /**
     * 評価画面
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getBuyerEvaluation(Chatroom $chatroom)
    {
        return view('chatroom.evaluation.create', compact('chatroom'));
    }

    /**
     * 購入者評価
     * @param  EvaluationRequest $request
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function buyerEvaluation(EvaluationRequest $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $evaluation = $this->evaluation_service->storeEvaluation($request->all(), $chatroom);
            $this->chatroom_message_service->storeEvaluationMessage($evaluation, $chatroom);
            $this->chatroom_service->statusChangeSellerEvaluation($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });

        return redirect()->route('chatroom.evaluation.complete', $chatroom->id);
    }

    /**
     * 評価画面
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getSellerEvaluation(Chatroom $chatroom)
    {
        return view('chatroom.evaluation.create', compact('chatroom'));
    }

    /**
     * 出品者評価
     * @param  EvaluationRequest $request
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function sellerEvaluation(EvaluationRequest $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $evaluation = $this->evaluation_service->storeEvaluation($request->all(), $chatroom);
            $this->chatroom_message_service->storeEvaluationMessage($evaluation, $chatroom);
            $this->chatroom_service->statusChangeComplete($chatroom, $this->purchase_service);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
            // 両者に取引完了pointを与える
            $this->point_service->getPoint(MPoint::TRANSACTION_COMPLETED, $chatroom->seller_user_id, $chatroom);
            $this->point_service->getPoint(MPoint::TRANSACTION_COMPLETED, $chatroom->buyer_user_id, $chatroom);
        });

        return redirect()->route('chatroom.evaluation.complete', $chatroom->id);
    }

    /**
     * キャンセルした側評価画面
     * @param \App\Models\Chatroom $chatroom
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getCancelSenderEvaluation(Chatroom $chatroom)
    {
        return view('chatroom.evaluation.cancel.createSender', compact('chatroom'));
    }

    /**
     * キャンセルした側評価画面
     * @param  CancelEvaluationRequest $request
     * @param \App\Models\Chatroom $chatroom
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function cancelSenderEvaluation(CancelEvaluationRequest $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $evaluation = $this->evaluation_service->storeEvaluation($request->all(), $chatroom);
            $this->chatroom_message_service->storeEvaluationMessage($evaluation, $chatroom);
            $this->chatroom_service->statusChangeCancelSender($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });

        return redirect()->route('chatroom.evaluation.cancel.sender.complete', $chatroom->id);
    }


    /**
     * キャンセル時、キャンセルした側評価完了画面
     * @param \App\Models\Chatroom $chatroom
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function evaluationCancelSenderComplete(Chatroom $chatroom)
    {
        $survey = KaribitoSurvey::where([
            ['user_id',\Auth::id()],
            ['chatroom_id', $chatroom->id],
        ])->get();

        return view('chatroom.evaluation.cancel.completeSender', compact('chatroom','survey'));
    }


    /**
     * キャンセルされた側評価画面
     * @param \App\Models\Chatroom $chatroom
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getCancelReceiverEvaluation(Chatroom $chatroom)
    {
        return view('chatroom.evaluation.cancel.createReceiver', compact('chatroom'));
    }


    /**
     * キャンセルされた側評価画面
     * @param  CancelEvaluationRequest $request
     * @param \App\Models\Chatroom $chatroom
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function cancelReceiverEvaluation(CancelEvaluationRequest $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $evaluation = $this->evaluation_service->storeEvaluation($request->all(), $chatroom);
            $this->chatroom_message_service->storeEvaluationMessage($evaluation, $chatroom);
            $this->chatroom_service->statusChangeCancelReceiver($chatroom);
            $this->user_notification_service->storeUserNotificationMessage($chatroom);
        });

        return redirect()->route('chatroom.evaluation.cancel.receiver.complete', $chatroom->id);
    }


    /**
     * キャンセル時、キャンセルされた側評価完了画面
     * @param \App\Models\Chatroom $chatroom
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function evaluationCancelReceiverComplete(Chatroom $chatroom)
    {
        $survey = KaribitoSurvey::where([
            ['user_id',\Auth::id()],
            ['chatroom_id', $chatroom->id],
        ])->get();

        return view('chatroom.evaluation.cancel.completeReceiver', compact('chatroom','survey'));
    }

    /**
     * 評価完了画面
     * @param \App\Models\Chatroom $chatroom
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function evaluationComplete(Chatroom $chatroom)
    {
        $survey = KaribitoSurvey::where([
            ['user_id',\Auth::id()],
            ['chatroom_id', $chatroom->id],
        ])->get();
        
        return view('chatroom.evaluation.complete', compact('chatroom','survey'));
    }

    /**
     * やりとりをゴミ箱へ
     * @param UpdateTrashFlgRequest $request
     * @param int $chatroom_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTrashFlg(UpdateTrashFlgRequest $request, int $chatroom_id)
    {
        \DB::transaction(function () use ($request, $chatroom_id) {
            $this->chatroom_service->updateTrashFlg($request->trash_flg, $chatroom_id);
        });
        return redirect()->route('chatroom.index');
    }
}
