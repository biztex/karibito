<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFollow;
use App\Models\Favorite;

class WithdrawController extends Controller
{
    /**
     * 退会フォームを表示
     */
    public function showWithdrawForm()
    {
        return view('mypage.withdraw');
    }

    public function withdraw(Request $request)
    {
        $user = \Auth::user();
        $str_delete = 'delete-'.$user->id.'-';

        \DB::transaction(function () use ($user, $str_delete) {

            \Auth::logout();// ログアウト
            UserFollow::where('following_user_id',$user->id)->orWhere('followed_user_id',$user->id)->delete();
            Favorite::where('user_id',$user->id)->delete();
            $user->delete(); // データ論理削除
            $user->email = $str_delete.$user->email;
            if ($user->google_id) {
                $user->google_id = $str_delete.$user->google_id;
            }
            if ($user->facebook_id) {
                $user->google_id = $str_delete.$user->google_id;
            }
            $user->save();
            \Session::put('flash_msg','退会しました');
        });

        return redirect()->route('home');
    }
}
