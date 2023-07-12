<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Age;
use App\Models\Chatroom;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;

use App\Models\UserProfile;
use App\Models\Prefecture;
use App\Models\Specialty;
use App\Models\Product;
use App\Models\PurchasedCancel;

class MypageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        $user_notifications = UserNotification::latest()->where('user_id', \Auth::id())->paginate(5);
        $products = Product::latest()->where('user_id', \Auth::id())->paginate(5);

        $purchased_cancel = new PurchasedCancel();
        $cancel_count = $purchased_cancel->getCancelCount(\Auth::id());

        $chatroom = new Chatroom;
        $total_sales_count = $chatroom->getSalesCount(\Auth::id());

        $url = url('register') . '?introduced_user_id=' . Auth::user()->id;

        return view('mypage.show', compact('user_notifications', 'products', 'cancel_count', 'total_sales_count', 'url'));
    }
}
