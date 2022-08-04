<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\Proposal;
use App\Models\KaribitoSurvey;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use App\Services\ChatroomService;
use App\Services\ChatroomMessageService;
use App\Services\ProposalService;
use App\Services\PurchaseService;
use App\Services\EvaluationService;
use App\Services\PaymentService;
use App\Http\Requests\ChatroomController\MessageRequest;
use App\Http\Requests\ChatroomController\ProposalRequest;
use App\Http\Requests\ChatroomController\EvaluationRequest;
use App\Models\MCommissionRate;
use Payjp\Token;


class ChatroomController extends Controller
{
    private $chatroom_service;
    private $chatroom_message_service;
    private $proposal_service;
    private $purchase_service;
    private $evaluation_service;
    private readonly PaymentService $payment_service;

    public function __construct(ChatroomService $chatroom_service, ChatroomMessageService $chatroom_message_service, ProposalService $proposal_service, PurchaseService $purchase_service, EvaluationService $evaluation_service, PaymentService $payment_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->chatroom_message_service = $chatroom_message_service;
        $this->proposal_service = $proposal_service;
        $this->purchase_service = $purchase_service;
        $this->evaluation_service = $evaluation_service;
        $this->payment_service = $payment_service;
    }

    /**
     * やりとり一覧画面
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $active_chatrooms = Chatroom::active()->orderBy('created_at','desc')->paginate(10);
        $inactive_chatrooms = Chatroom::inActive()->orderBy('created_at','desc')->paginate(10);

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
        $user_coupons = UserCoupon::where([
            ['user_id', '=', \Auth::id()],
            ['used_at', '=', null],
        ])
        ->get();

        $cards = $this->payment_service->getCardList();

        return view('chatroom.purchase.create',compact('proposal', 'cards', 'user_coupons'));
    }

    /**
     * 購入確認画面
     * @param \App\Models\Proposal $proposal
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchaseConfirm(Request $request, Proposal $proposal)
    {
        $card = $this->payment_service->getCard($request->card_id);

        return view('chatroom.purchase.confirm',compact('request', 'proposal', 'card'));
    }

    /**
     * 購入完了
     * @param \App\Models\Proposal $proposal
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchased(Request $request, Proposal $proposal)
    {
        $m_commission_rate = MCommissionRate::find(1); // クーポン後で組み込む
        \DB::transaction(function () use ($request, $proposal, $m_commission_rate) {
            if($request->immediate === null){
                $payjp_charge_id = $this->payment_service->createCustomerCharge($request['card_id'], $request['customer_id'], $request['amount']);
            } else {
                $token = $this->payment_service->createToken($request->all());
                $payjp_charge_id = $this->payment_service->createCharge($token, $request['amount']);
            }
            $payment = $this->payment_service->storePayment($payjp_charge_id, $request['amount']);
            $this->proposal_service->purchasedProposal($proposal);
            $purchase = $this->purchase_service->storePurchase($proposal, $payment, $m_commission_rate);
            $this->chatroom_message_service->storePurchaseMessage($purchase, $proposal->chatroom);
            $this->chatroom_service->statusChangeWork($proposal->chatroom);
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
