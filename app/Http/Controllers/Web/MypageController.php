<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Http\Requests\UserProfileRequest;


class MypageController extends Controller
{
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
     * マイページ画面を表示する
     * 
     * @return view
     */
    public function showMypage()
    {
        return view('sample.mypage');
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

    public function storeProfile(Request $request)
    {
        $birthday = $request->year.'-'.$request->month.'-'.$request->day;
        $user_id = 1;
        
                $profile = new UserProfile();
                $profile->fill([
                    'user_id' => $user_id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'prefecture' => $request->prefecture,
                    'birthday' => $birthday,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'introduction' => $request->introduction,
                    // 'icon' => $request->icon,
                    // 'cover' => $request->cover
                ]);
                $profile->save();

        return redirect()->route('showMypage');
    }

}
