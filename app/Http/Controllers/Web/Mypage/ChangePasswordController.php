<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\ChangePasswordController\UpdateRequest;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('setting.password');
    }

    public function update(UpdateRequest $request)
    {
        $new_password = $request->password;

        User::where('id', \Auth::id())
            ->update(['password' => \Hash::make($new_password)]);

        return back()->with('flash_msg', 'パスワードを変更しました。');
    }
}
