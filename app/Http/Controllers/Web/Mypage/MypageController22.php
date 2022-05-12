<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * 過去取引一覧画面を表示する
     * 
     * @return view
     */
    public function indexPast()
    {
        return view('sample.past');
    }

}
