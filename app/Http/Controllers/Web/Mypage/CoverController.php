<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\UpdateCoverRequest;
use App\Services\UserProfileService;
use App\Models\UserProfile;


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
        return redirect()->route('mypage');
    }


    public function delete() 
    {
        $this->user_profile_service->deleteUserProfileImage('cover');
        return redirect()->route('mypage');
    }
}