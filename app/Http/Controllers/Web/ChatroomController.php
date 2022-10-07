<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\Proposal;
use App\Models\KaribitoSurvey;
use Illuminate\Http\Request;
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

    private readonly StripeService $stripe_service;

    public function __construct(ChatroomService $chatroom_service, ChatroomMessageService $chatroom_message_service, ProposalService $proposal_service, PurchaseService $purchase_service, EvaluationService $evaluation_service, PointService $point_service, CouponService $coupon_service, UserNotificationService $user_notification_service, StripeService $stripe_service)
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
    }

    /**
     * やりとり一覧画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $active_chatrooms = Chatroom::active()->orderBy('updated_at','desc')->paginate(10);
        $inactive_chatrooms = Chatroom::inActive()->orderBy('updated_at','desc')->paginate(10);

        return view('chatroom.index', compact('active_chatrooms','inactive_chatrooms'));
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
            $this->chatroom_message_service->storeNormalMessage($request->all(), $chatroom);

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
            $this->chatroom_message_service->storeNormalMessage($request->all(), $chatroom);
            
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
        \DB::transaction(function () use ($request, $proposal) {
            // 金額取得
            $amount = $this->purchase_service->getFinalAmount($proposal, $request->all());
            // stripe支払い処理
            $charge_id = $this->stripe_service->createCheckout($request->all(), $amount['total']);
            // 購入完了処理
            $this->purchase_service->purchased($charge_id, $amount['total'], $proposal);
            // pointを与える
            // $this->point_service->getPoint($proposal->chatroom, $amount['total']); // 仕様が変わる可能性があるため一旦非表示、取得ポイントは手数料含めるか確認
            // pointを消化する
            $this->point_service->usedPoint($proposal->chatroom, $amount['use_point']);
            // couponを消化する
            $this->coupon_service->usedCoupon($request->coupon_number);
            // 購入物作成
            $this->purchase_service->savePurchasedProduct($proposal);
        });

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
            $this->chatroom_service->statusChangeComplete($chatroom);
        });

        return redirect()->route('chatroom.evaluation.complete', $chatroom->id);
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

}
