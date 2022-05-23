<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Mypage\MypageController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;

use App\Http\Requests\UserProfile\StoreRequest;
use App\Http\Requests\UserProfile\UpdateRequest;

use App\Services\UserProfileService;

class UserProfileController extends Controller
{

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
        \DB::transaction(function () use ($request) {
            $this->user_profile_service->updateUser($request->all());
            $this->user_profile_service->storeUserProfile($request->all());
        });
        
        return redirect()->route('complete.show');
    }

    public function showComplete()
    {
        $user = UserProfile::with('user')->firstWhere('user_id',Auth::id());

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
        $birthday = $request->year.'-'.$request->month.'-'.$request->day;

        \DB::transaction(function () use ($request) {
                $user = User::find(Auth::id());
                $user->fill(['name' => $request->name ])->save();

                $user_profile = UserProfile::firstWhere('user_id',Auth::id());
                $user_profile->fill([
                    'user_id' => Auth::id(),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'prefecture_id' => $request->prefecture,
                    'birthday' => $birthday,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'introduction' => $request->introduction,
                ]);

                if(isset($request->cover)){
                    $user_profile->cover = $request->file('cover')->store('covers','public');
                }
                if(isset($request->icon)){
                    $user_profile->icon = $request->file('icon')->store('icons','public');
                }

                $user_profile->save();
        });

        return redirect()->action([MypageController::class, 'show']);
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
