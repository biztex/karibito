<?php

namespace App\Http\Controllers\Web\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;

class MypageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_profile = UserProfile::where('user_id',Auth::id())
                        ->leftjoin('users','users.id','=','user_profiles.user_id')
                        ->select(['user_profiles.*','users.email as email','users.name as name'])
                        ->first();
                        session()->put('user_profile_id',$user_profile->id);
        
        $prefectures = Prefecture::all();
        $user_prefecture = Prefecture::where('id',$user_profile->prefecture_id)->first()->name;

        if($user_profile->gender == 1){
            $gender = '男性';
        }else{
            $gender = '女性';
        };

        $now = (int)date('Ymd');
        $birthday = (int)str_replace("-","",$user_profile->birthday);
        $now_age = floor(($now - $birthday) / 10000);
        if($now_age < 0 || $now_age > 150 || empty($now_age)){
            $age = '不明';
        }elseif($now_age < 20){
            $age = '10代';
        }elseif($now_age < 30){
            $age = '20代';
        }elseif($now_age < 40){
            $age = '30代';
        }elseif($now_age < 50){
            $age = '40代';
        }elseif($now_age < 60){
            $age = '50代';
        }elseif($now_age < 70){
            $age = '60代';
        }elseif($now_age > 69){
            $age = '70代以上';
        }else{
            $age = '不明';
        }


        return view('sample.mypage',compact('user_profile','prefectures','user_prefecture','gender','age'));
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
