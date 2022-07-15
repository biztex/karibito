<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductChatroom;
use App\Models\ProductProposal;
use App\Services\ProductChatroomService;
use App\Services\ProductProposalService;
use App\Services\ProductEvaluationService;
use App\Http\Requests\ProductChatroom\MessageRequest;

class ProductChatroomController extends Controller
{
    private $product_chatroom_service;
    private $product_proposal_service;

    public function __construct(ProductChatroomService $product_chatroom_service, ProductProposalService $product_proposal_service, ProductEvaluationService $product_evaluation_service)
    {
        $this->product_chatroom_service = $product_chatroom_service;
        $this->product_proposal_service = $product_proposal_service;
        $this->product_evaluation_service = $product_evaluation_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function newroom(Product $product)
    {
        return view('chatroom.samples.product.newroom', compact('product'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function start(MessageRequest $request, Product $product)
    {
        $product_chatroom = $this->product_chatroom_service->startProductChatroom($product);
        $this->product_chatroom_service->storeProductChatroomMessage($request->all(), $product_chatroom);

        return redirect()->route('chatroom.product.show', $product_chatroom->id);
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(ProductChatroom $product_chatroom)
    {
        $product = $product_chatroom->product;
        $messages = $product_chatroom->productChatroomMessage;

        return view('chatroom.samples.product.show', compact('product', 'product_chatroom', 'messages'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function message(MessageRequest $request, ProductChatroom $product_chatroom)
    {
        $this->product_chatroom_service->storeProductChatroomMessage($request->all(), $product_chatroom);

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function proposal(Request $request, ProductChatroom $product_chatroom)
    {
        \DB::transaction(function () use ($request, $product_chatroom) {
            $product_proposal = $this->product_proposal_service->storeProductProposal($request->all(), $product_chatroom);
            $this->product_chatroom_service->storeProductProposalMessage($product_proposal, $product_chatroom);
            $this->product_chatroom_service->statusChangeContract($product_chatroom);
        });

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchese(ProductProposal $product_proposal)
    {
        return view('chatroom.samples.cart_buy03',compact('product_proposal'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchese_confirm(ProductProposal $product_proposal)
    {
        return view('chatroom.samples.cart_buy04',compact('product_proposal'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchesed(ProductProposal $product_proposal)
    {
        \DB::transaction(function () use ($product_proposal) {
            $this->product_proposal_service->purchesedProductProposal($product_proposal);
            $this->product_chatroom_service->statusChangeWork($product_proposal);
        });
        return view('chatroom.samples.cart_buy05', compact('product_proposal'));
    }

    // 作業完了
    public function complete(ProductChatroom $product_chatroom)
    {
        $this->product_chatroom_service->storeProductCompleteMessage($product_chatroom);
        $this->product_chatroom_service->statusChangeBuyerEvaluation($product_chatroom);

        return back();
    }

    // 評価画面
    public function evaluation(ProductChatroom $product_chatroom)
    {
        return view('chatroom.samples.product.evaluation', compact('product_chatroom'));
    }

    // 購入者評価
    public function buyerEvaluation(Request $request, ProductChatroom $product_chatroom)
    {
        \DB::transaction(function () use ($request, $product_chatroom) {
            $product_evaluation = $this->product_evaluation_service->storeProductEvaluation($request->all(), $product_chatroom);
            $this->product_chatroom_service->storeProductEvaluationMessage($product_evaluation, $product_chatroom);
            $this->product_chatroom_service->statusChangeSellerEvaluation($product_chatroom);
        });

        return redirect()->route('chatroom.complete.evaluation');
    }

    // 出品者評価
    public function sellerEvaluation(Request $request, ProductChatroom $product_chatroom)
    {
        \DB::transaction(function () use ($request, $product_chatroom) {
            $product_evaluation = $this->product_evaluation_service->storeProductEvaluation($request->all(), $product_chatroom);
            $this->product_chatroom_service->storeProductEvaluationMessage($product_evaluation, $product_chatroom);
            $this->product_chatroom_service->statusChangeComplete($product_chatroom);
        });

        return redirect()->route('chatroom.complete.evaluation');
    }

    // sample
    public function sample(Product $product)
    {
        return view('chatroom.samples.sample', compact('product'));
    }
}
