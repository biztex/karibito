<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Age;
use Illuminate\Support\Facades\Auth;

use App\Models\UserProfile;
use App\Models\Prefecture;


class MypageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_profile = UserProfile::firstWhere('user_id',Auth::id());

        $age = Age::group($user_profile->birthday);

        return view('mypage.profile.mypage', compact('age'));
    }

}
