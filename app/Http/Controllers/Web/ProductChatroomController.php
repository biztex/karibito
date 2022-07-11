<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductChatroom;
use App\Models\ProductProposal;
use App\Services\ProductChatroomService;
use App\Services\ProductProposalService;
use App\Http\Requests\ProductChatroom\MessageRequest;

class ProductChatroomController extends Controller
{
    private $product_chatroom_service;
    private $product_proposal_service;

    public function __construct(ProductChatroomService $product_chatroom_service, ProductProposalService $product_proposal_service)
    {
        $this->product_chatroom_service = $product_chatroom_service;
        $this->product_proposal_service = $product_proposal_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function newroom(Product $product)
    {
        return view('chatroom.product.newroom', compact('product'));
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

        return view('chatroom.product.show', compact('product', 'product_chatroom', 'messages'));
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
        return view('chatroom.cart_buy03',compact('product_proposal'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function purchese_confirm(ProductProposal $product_proposal)
    {
        return view('chatroom.cart_buy04',compact('product_proposal'));
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
        return view('chatroom.cart_buy05', compact('product_proposal'));
    }

    // sample
    public function sample(Product $product)
    {
        return view('chatroom.sample', compact('product'));
    }
}
