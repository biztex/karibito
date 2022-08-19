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

        $specialty = Specialty::Where('user_id',Auth::id());
        $specialties = $specialty->get();

        return view('mypage.show', compact('user_notifications', 'specialties', 'products'));
    }
}
