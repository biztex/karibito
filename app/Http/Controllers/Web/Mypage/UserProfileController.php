<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Mypage\MypageController;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;

use App\Http\Requests\UserProfile\StoreRequest;
use App\Http\Requests\UserProfile\UpdateRequest;
use Laravel\Socialite\Facades\Socialite;


use App\Services\UserProfileService;

class UserProfileController extends Controller
{

    const DRIVER_GOOGLE = 'google';
    const DRIVER_FACEBOOK = 'facebook';

    private $user_profile_service;

    public function __construct(UserProfileService $user_profile_service)
    {
        $this->user_profile_service = $user_profile_service;

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefectures = Prefecture::all();
        return view('mypage.profile.create',compact('prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $driver_name = '';
        if(\Auth::user()->google_id){
            $driver_name = self::DRIVER_GOOGLE;
            $sns_user = Socialite::driver($driver_name)->userFromToken(\Auth::user()->google_token);
            // dd($user);
            // $sns_user = Socialite::driver($driver_name)->toke()->user();
        }elseif(\Auth::user()->facebook_id){
            $driver_name = self::DRIVER_FACEBOOK;
            $sns_user = Socialite::driver($driver_name)->userFromToken(\Auth::user()->facebook_token);
        }
        if(!$driver_name == ''){
            // 画像の保存、画像URLが取得できなかった時の対策でfile_get_contentsの前に@をつけている
            $img = @file_get_contents($sns_user->avatar);
            $fileName = null;
            if ($img !== false) {
                $fileName = 'icons/' . $driver_name . '_' . uniqid() . '.jpg';
                \Storage::put('public/' . $fileName, $img, 'public');
                $request->merge(['icon' => $fileName]);
            }
        }

        \DB::transaction(function () use ($request) {
            $this->user_profile_service->updateUser($request->all());
            $this->user_profile_service->storeUserProfile($request->all());
        });

        return redirect()->route('complete.show');
    }

    /**
     * 基本情報登録完了画面
     */
    public function showComplete()
    {
        $user = UserProfile::with('user')->firstWhere('user_id',\Auth::id());

        return view('mypage.profile.created',compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        \DB::transaction(function () use ($request) {

            $this->user_profile_service->updateUser($request->all());
            $this->user_profile_service->updateUserProfile($request);
            $this->user_profile_service->updateUserProfileImage($request,'cover');
            $this->user_profile_service->updateUserProfileImage($request,'icon');

        });

        return redirect()->route('mypage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
