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

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('user_profile.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!empty(UserProfile::all()->where('user_id',Auth::id())->first())){
            
            return redirect()->action([MypageController::class,'show']);
        }
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
        
        $user_id = Auth::id();
        // dd($user_id);

        $user = User::find($user_id);
        $user->fill([ 'name' => $request->name ])->save();
            session()->put('user_name',$request->name);

        $user_profile = UserProfile::create([
            'user_id' => $user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'prefecture_id' => $request->prefecture
        ]);
        $user_profile->save();
        $id = $user_id;

        return redirect()->route('showComplete',compact('id'));
    }

    public function showComplete()
    {
        $user_name = session()->get('user_name');
        // $id = $id;

        return view('mypage.profile.created',compact('user_name'));

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
    public function update(UpdateRequest $request,$id)
    {
        $birthday = $request->year.'-'.$request->month.'-'.$request->day;
        $user_profile_id = session()->get('user_profile_id');

                $user = User::find($id);
                $user->fill([
                    'name' => $request->name,
                    // 'email' => $request->email
                ]);
                $user->save();

                $user_profile = UserProfile::find($user_profile_id);
                $user_profile->fill([
                    'user_id' => $id,
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
                    $cover = $request->file('cover')->store('covers','public');
                        $user_profile->cover=str_replace('public/','',$cover);
                }
                if(isset($request->icon)){
                    $icon = $request->file('icon')->store('icons','public');
                        $user_profile->icon=str_replace('public/','',$icon);
                }
                $user_profile->save();

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
