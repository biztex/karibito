<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\UpdateCoverRequest;
use App\Models\UserProfile;



class CoverController extends Controller
{
    public function update(UpdateCoverRequest $request) {

        $user_profile_id = session()->get('user_profile_id');
        $user_profile = UserProfile::find($user_profile_id);

            $cover = $request->file('file')->store('covers','public');
            $user_profile->cover=str_replace('public/','',$cover);
    
        $user_profile->save();

        return redirect()->action([MypageController::class, 'show']);
    }
}
