<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Age;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

use App\Models\UserProfile;
use App\Models\Prefecture;

class MypageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        $user_profile = UserProfile::firstWhere('user_id',Auth::id());
        $news_list = News::orderBy('created_at','desc')->paginate(5);

        if ($user_profile->birthday !== NULL){
            $age = Age::group($user_profile->birthday);
        } else {
            $age = '不明';
        }

        return view('mypage.profile.mypage', compact('age', 'news_list'));
    }
}
