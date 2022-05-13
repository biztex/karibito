<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Mypage\MypageController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::check()){
        //     $id = Auth::id();
        //     return redirect()->route('user_profile.show',$id);
        // }
        $prefectures = Prefecture::all();
        return view('mypage.profile.create',compact('prefectures'));
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
    public function store(Request $request)
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

    public function showComplete($id)
    {
        $user_name = session()->get('user_name');
        // $id = $id;

        return view('mypage.profile.created',compact('user_name','id'));

    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show()
    // {
    //     // $user_id = $id; //Auth::user()->id();
    //     // $id = $id;
    //     // dd($id);

    //     $user_profile = UserProfile::where('user_id',$id)
    //                     ->leftjoin('users','users.id','=','user_profiles.user_id')
    //                     ->select(['user_profiles.*','users.email as email','users.name as name'])
    //                     ->first();
    //                     session()->put('user_profile_id',$user_profile->id);
        
    //     $prefectures = Prefecture::all();
    //     $user_prefecture = Prefecture::where('id',$user_profile->prefecture_id)->first()->name;

    //     if($user_profile->gender == 1){
    //         $gender = '男性';
    //     }else{
    //         $gender = '女性';
    //     };

    //     $now = (int)date('Ymd');
    //     $birthday = (int)str_replace("-","",$user_profile->birthday);
    //     $now_age = floor(($now - $birthday) / 10000);
    //     if($now_age < 0 || $now_age > 150 || empty($now_age)){
    //         $age = '不明';
    //     }elseif($now_age < 20){
    //         $age = '10代';
    //     }elseif($now_age < 30){
    //         $age = '20代';
    //     }elseif($now_age < 40){
    //         $age = '30代';
    //     }elseif($now_age < 50){
    //         $age = '40代';
    //     }elseif($now_age < 60){
    //         $age = '50代';
    //     }elseif($now_age < 70){
    //         $age = '60代';
    //     }elseif($now_age > 69){
    //         $age = '70代以上';
    //     }else{
    //         $age = '不明';
    //     }


    //     return view('sample.mypage',compact('id','user_profile','prefectures','user_prefecture','gender','age'));
    // }

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
    public function update(Request $request,$id)
    {
        $birthday = $request->year.'-'.$request->month.'-'.$request->day;
        $user_profile_id = session()->get('user_profile_id');

                $user = User::find($id);
                $user->fill([
                    'name' => $request->name,
                    'email' => $request->email
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
