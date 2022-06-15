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
        $user_profile = UserProfile::with(['user', 'prefecture'])->firstWhere('user_id', Auth::id());

        $birthday = (int)str_replace("-", "", $user_profile->birthday);
        $age = Age::group($birthday);

        return view('mypage.profile.mypage', compact('age'));
    }

    /**
     * お気に入り一覧画面を表示する
     *
     * @return view
     */
    public function indexFavorite()
    {
        return view('sample.favorite');
    }

    /**
     * 友達一覧画面を表示する
     *
     * @return view
     */
    public function indexFriends()
    {
        return view('sample.friends');
    }

    /**
     * メンバー情報画面を表示する
     *
     * @return view
     */
    public function showMember()
    {
        return view('sample.member');
    }


    /**
     * 過去取引一覧画面を表示する
     *
     * @return view
     */
    public function indexPast()
    {
        return view('sample.past');
    }

}
