<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\UpdateCoverRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;



class CoverController extends Controller
{
    public function update(UpdateCoverRequest $request) {

        $user_profile = UserProfile::firstWhere('user_id',Auth::id());
        $user_profile->cover = $request->file('file')->store('covers','public');

        $user_profile->save();

        return redirect()->action([MypageController::class, 'show']);
    }
}
