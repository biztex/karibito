<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Age;
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
        $cancel_count = PurchasedCancel::whereHas('purchase.chatroom', function ($chatroom) {
            $chatroom->where('seller_user_id', \Auth::id())
                ->orWhere('buyer_user_id', \Auth::id());
        })->whereNotNull('cancel_date')->count();

        return view('mypage.show', compact('user_notifications', 'products', 'cancel_count'));
    }
}
