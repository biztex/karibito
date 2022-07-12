<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductChatroom;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $active_product_chatrooms = ProductChatroom::active()->loginUser()->get();
        $inactive_product_chatrooms = ProductChatroom::inActive()->loginUser()->get();

        return view('chatroom.index', compact('active_product_chatrooms','inactive_product_chatrooms'));
    }
}
