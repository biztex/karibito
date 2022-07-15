<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Services\ChatroomService;
use App\Services\ProposalService;
use App\Services\PurchaseService;
use App\Services\EvaluationService;
use App\Http\Requests\ProductChatroom\MessageRequest;


class ChatroomController extends Controller
{
    private $chatroom_service;
    private $proposal_service;
    private $purchase_service;
    private $evaluation_service;

    public function __construct(ChatroomService $chatroom_service, ProposalService $proposal_service, PurchaseService $purchase_service, EvaluationService $evaluation_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->proposal_service = $proposal_service;
        $this->purchase_service = $purchase_service;
        $this->evaluation_service = $evaluation_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $active_product_chatrooms = Chatroom::active()->product()->get();
        $inactive_product_chatrooms = Chatroom::inActive()->product()->get();

        return view('chatroom.index', compact('active_product_chatrooms','inactive_product_chatrooms'));
    }

    /**
     * Display a listing of the resource.
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
     * Display a listing of the resource.
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createProduct(MessageRequest $request, Product $product)
    {
        $chatroom = $this->chatroom_service->startChatroomProduct($product);
        $this->chatroom_service->storeChatroomMessage($request->all(), $chatroom);

        return redirect()->route('chatroom.show', $chatroom->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createJobRequest(MessageRequest $request, JobRequest $job_request)
    {
        $chatroom = $this->chatroom_service->startChatroomJobRequest($job_request);
        $this->chatroom_service->storeChatroomMessage($request->all(), $chatroom);

        return redirect()->route('chatroom.show', $chatroom->id);
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Chatroom $chatroom)
    {
       
        if($chatroom->seller_user_id === \Auth::id()){
            $partner = $chatroom->buyerUser;
        } else {
            $partner = $chatroom->sellerUser;
        }

        return view('chatroom.show', compact('chatroom', 'partner'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function message(MessageRequest $request, Chatroom $chatroom)
    {
        $this->chatroom_service->storeChatroomMessage($request->all(), $chatroom);

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function proposal(Request $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $proposal = $this->proposal_service->storeProposal($request->all(), $chatroom);
            $this->chatroom_service->storeProposalMessage($proposal, $chatroom);
            $this->chatroom_service->statusChangeContract($chatroom);
        });

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchase(Proposal $proposal)
    {
        return view('chatroom.purchase.create',compact('proposal'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchaseConfirm(Proposal $proposal)
    {
        return view('chatroom.purchase.confirm',compact('proposal'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchased(Proposal $proposal)
    {
        \DB::transaction(function () use ($proposal) {
            $this->proposal_service->purchasedProposal($proposal);
            $purchase = $this->purchase_service->storePurchase($proposal->chatroom);
            $this->chatroom_service->storePurchaseMessage($purchase, $proposal->chatroom);
            $this->chatroom_service->statusChangeWork($proposal);
        });
        return view('chatroom.purchase.complete', compact('proposal'));
    }

    // 作業完了
    public function complete(Chatroom $chatroom)
    {
        $this->chatroom_service->storeCompleteMessage($chatroom);
        $this->chatroom_service->statusChangeBuyerEvaluation($chatroom);

        return back();
    }

    // 評価画面
    public function evaluation(Chatroom $chatroom)
    {
        return view('chatroom.evaluation.create', compact('chatroom'));
    }

    // 購入者評価
    public function buyerEvaluation(Request $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $evaluation = $this->evaluation_service->storeEvaluation($request->all(), $chatroom);
            $this->chatroom_service->storeEvaluationMessage($evaluation, $chatroom);
            $this->chatroom_service->statusChangeSellerEvaluation($chatroom);
        });

        return redirect()->route('chatroom.evaluation.complete', $chatroom->id);
    }

    // 出品者評価
    public function sellerEvaluation(Request $request, Chatroom $chatroom)
    {
        \DB::transaction(function () use ($request, $chatroom) {
            $evaluation = $this->evaluation_service->storeEvaluation($request->all(), $chatroom);
            $this->chatroom_service->storeEvaluationMessage($evaluation, $chatroom);
            $this->chatroom_service->statusChangeComplete($chatroom);
        });

        return redirect()->route('chatroom.evaluation.complete', $chatroom->id);
    }

    // 評価完了画面
    public function evaluationComplete(Chatroom $chatroom)
    {
        return view('chatroom.evaluation.complete', compact('chatroom'));
    }

}
