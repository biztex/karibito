<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\UpdateCoverRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;

use App\Services\UserProfileService;


class CoverController extends Controller
{

    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;

    }

    public function update(UpdateCoverRequest $request) 
    {
        $this->user_profile_service->updateUserProfileImage($request,'cover');
        return redirect()->action([MypageController::class, 'show']);
    }


    public function delete() 
    {
        $this->user_profile_service->deleteUserProfileImage('cover');
        return redirect()->action([MypageController::class, 'show']);
    }
}