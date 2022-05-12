<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Mypage\CreateRequest;


use App\Models\User;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    // プロフィール作成画面表示
    public function index()
    {
        return view('mypage.profile.create');
    }
     // プロフィール作成画面表示
    public function create(Request $request)
    {
        $user = User::find(1);
        $user->name = $request->name;
        $user->save();
        $request->merge([
            'user_id' => 1,
            'prefecture' => 1,
    ]);

        // dd($request->all());
        UserProfile::create($request->all());
            // 'user_id' => 1,

        return view('mypage.profile.create');
    }
}
