<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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

        \DB::transaction(function () use ($user) {

            \Auth::logout();// ログアウト
            $user->delete(); // データ論理削除
        });

        \Session::put('flash_msg','退会しました');


        return redirect()->route('home');
    }
}
