<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Mypage\CreateRequest;


use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;

class UserProfileController extends Controller
{
    
    // 会員登録画面表示
    public function createUser()
    {
        $prefectures = Prefecture::all();
        // dd($prefectures);
        return view('mypage.profile.create',compact('prefectures'));
    }
     // 会員登録
    public function storeUser(Request $request)
    {

        $user_id = 1; //Auth::user()->id();

        $user = User::find($user_id);
        $user->fill([ 'name' => $request->name ]);
        $user->save();
            session()->put('user_name',$request->name);

        $user_profile = UserProfile::create([
            'user_id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'prefecture' => $request->prefecture
        ]);
        $user_profile->save();

        return redirect()->route('showComplete');
    }
    // 会員登録
    public function showComplete()
    {
        $user_name = session()->get('user_name');

        return view('mypage.profile.created',compact('user_name'));

    }

    /**
     * マイページ画面を表示する
     * 
     * @return view
     */
    public function showMypage()
    {
        $user_id = 1; //Auth::user()->id();

        $user_profile = UserProfile::where('user_id',$user_id)
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

        $now = date('Ymd');
        $birthday = str_replace("-","",$user_profile->birthday);
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
     * プロフィールを編集する
     * 
     * @return view
     */
    public function updateProfile(Request $request)
    {
        $birthday = $request->year.'-'.$request->month.'-'.$request->day;
        $user_id = 1;
        $user_profile_id = session()->get('user_profile_id');

                $user = User::find($user_id);
                $user->fill([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
                $user->save();

                $user_profile = UserProfile::find($user_profile_id);
                $user_profile->fill([
                    'user_id' => $user_id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'prefecture_id' => $request->prefecture,
                    'birthday' => $birthday,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'introduction' => $request->introduction,
                ]);

                if(isset($request->cover)){
                    $cover = $request->file('cover')->store('covers','public');
                        $user_profile->cover=str_replace('public/','',$cover);
                }
                if(isset($request->icon)){
                    $icon = $request->file('icon')->store('icons','public');
                        $user_profile->icon=str_replace('public/','',$icon);
                }
                $user_profile->save();

        return redirect()->route('showMypage');
    }

}
