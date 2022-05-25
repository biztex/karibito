<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Services\UserProfileService;
use App\Http\Requests\UserProfile\StoreRequest;

class IconController extends Controller
{

    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;

    }
    public function delete() {

        $this->user_profile_service->deleteUserProfileImage('icon');

        return redirect()->route('mypage');
    }
}
