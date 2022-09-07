<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFollow;

class FollowController extends Controller
{
    /**
     * フォロー・フォロワーを表示する
     *
     *
     */
    public function index()
    {
        $followings = UserFollow::where('followed_user_id', \Auth::user()->id)->paginate(10);
        $followeds = UserFollow::where('following_user_id', \Auth::user()->id)->paginate(10);
        return view('mypage.follow.index', compact('followings', 'followeds'));
    }

    /**
     * フォローする
     *
     *
     */
    public function addFollow($id)
    {
        UserFollow::create([
            'following_user_id' => $id,
            'followed_user_id' => \Auth::user()->id,
        ]);
        return redirect()->back()->with('flash_msg', 'フォローしました！');
    }

    /**
     * フォローを解除する
     *
     *
     */
    public function subFollow($id)
    {
        UserFollow::GetFollowing($id)->delete();
        return redirect()->back()->with('flash_msg', 'フォロー解除しました！');
    }
}
