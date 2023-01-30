<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFollow;
use App\Services\ChatroomService;
use App\Services\FavoriteService;
use App\Http\Requests\WithdrawController\StoreRequest;
use App\Mail\User\WithdrawMail;

class WithdrawController extends Controller
{
    private $chatroom_service;

    public function __construct(ChatroomService $chatroom_service, FavoriteService $favorite_service)
    {
        $this->chatroom_service = $chatroom_service;
        $this->favorite_service = $favorite_service;
    }

    /**
     * 退会フォームを表示
     */
    public function showWithdrawForm()
    {
        return view('mypage.withdraw');
    }

    public function withdraw(StoreRequest $request)
    {
        $user = \Auth::user();
        $this->chatroom_service->canIWithdraw($user);
        $str_delete = 'delete-'.$user->id.'-';

        if ((\Auth::user()->sub_email)) {
            \Mail::to($user->email)
                ->cc(\Auth::user()->sub_email)
                ->send(new WithdrawMail($user));
        } else {
            \Mail::to($user->email)
                ->send(new WithdrawMail($user));
        }

        \DB::transaction(function () use ($user, $str_delete, $request) {

            \Auth::logout();// ログアウト
            UserFollow::where('following_user_id',$user->id)->orWhere('followed_user_id',$user->id)->delete();
            $this->favorite_service->deleteFavorites($user);
            $user->withdraw_reason = $request->withdraw_reason;
            $user->delete(); // データ論理削除
            $user->email = $str_delete.$user->email;
            if ($user->google_id) {
                $user->google_id = $str_delete.$user->google_id;
            }
            if ($user->facebook_id) {
                $user->facebook_id = $str_delete.$user->facebook_id;
            }
            $user->save();
            \Session::put('flash_msg','退会しました');
        });

        return redirect()->route('home');
    }
}
