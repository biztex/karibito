<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductChatroom;
use App\Services\ProductChatroomService;
use App\Http\Requests\ProductChatroom\MessageRequest;

class ProductChatroomController extends Controller
{
    private $product_chatroom_service;

    public function __construct(ProductChatroomService $product_chatroom_service)
    {
        $this->product_chatroom_service = $product_chatroom_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('chatroom.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function newroom(Product $product)
    {
        $user_id = \Auth::id();

        if ($product->user_id === \Auth::id()) {
            return redirect()->route('product.show', $product->id);
        }
        elseif (ProductChatroom::where('product_id', $product->id)->where(function ($query) use ($user_id) {
                $query->orWhere('seller_user_id', $user_id)->orWhere('buyer_user_id', $user_id);
            })->exists())
        {
            $product_chatroom = ProductChatroom::where('product_id', $product->id)->where(function ($query) use ($user_id) {
                $query->orWhere('seller_user_id', $user_id)->orWhere('buyer_user_id', $user_id);
                })->first();

                return redirect()->route('chatroom.product.show', $product_chatroom->id);
            }        

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

    public function show(ProductChatroom $product_chatroom)
    {
        $product = $product_chatroom->product;
        $messages = $product_chatroom->productChatroomMessage;
        return view('chatroom.product.show', compact('product', 'product_chatroom', 'messages'));
    }

    public function message(MessageRequest $request, ProductChatroom $product_chatroom)
    {
        $this->product_chatroom_service->storeProductChatroomMessage($request->all(), $product_chatroom);

        return back();
    }



    /**
     * sample
     */
    public function sample(Product $product)
    {
        return view('chatroom.sample', compact('product'));
    }
}
