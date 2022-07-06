<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ChatRoomController extends Controller
{
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
    public function show(Product $product)
    {
        if (\Auth::id() === $product->user_id) {
            return redirect()->route('product.show',$product->id);
        };
        return view('chatroom.buy.product', compact('product'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function sample(Product $product)
    {
        if (\Auth::id() === $product->user_id) {
            return redirect()->route('product.show',$product->id);
        };
        return view('chatroom.sample', compact('product'));
    }
}
