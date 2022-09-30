<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\UpdateIdentificationRequest;
use App\Services\UserProfileService;

class IdentificationController extends Controller
{
    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;

    }

    public function index()
    {
        return back();
    }

    public function upload(UpdateIdentificationRequest $request)
    {
           $this->user_profile_service->updateIdentification($request->identification_path);

        return back()->with('flash_msg','身分証明証を提出しました！');
    }
}
