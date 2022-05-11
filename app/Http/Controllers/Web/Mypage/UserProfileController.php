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

        $user_id = 5; //Auth::user()->id();

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
        return view('sample.mypage');
    }
    
    /**
     * プロフィールを編集する
     * 
     * @return view
     */
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
