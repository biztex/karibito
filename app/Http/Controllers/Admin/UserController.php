<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;
use App\Libraries\Age;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = UserProfile::orderBy('updated_at','desc')->paginate(50);

        return view('admin.user.index',compact('users'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserProfile::with(['user', 'prefecture'])->firstWhere('user_id', $id);
        $birthday = (int) str_replace("-","", $user->birthday);
        $now_age = Age::nowAge($birthday);
        $age = Age::group($birthday);
        return view('admin.user.show',compact('user','age','now_age'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }

    /**
     * 身分証明証の承認をする
     *
     */
    public function approve($id)
    {
        $user = UserProfile::firstWhere('user_id',$id);
        $user->fill(['is_identify' => 1])->save();

        $flash_msg = "id:" . $user->user_id . " " . $user->first_name . $user->last_name . "さんの本人確認を承認しました！";
        return back()->with('flash_msg',$flash_msg);
    }

    /**
     * 身分証明証の承認を取り消す
     *
     */
    public function revokeApproval($id)
    {
        $user = UserProfile::firstWhere('user_id',$id);
        $user->fill(['is_identify' => 0])->save();

        $flash_msg = "id:" . $user->user_id . " " . $user->first_name . $user->last_name . "さんの本人確認の承認を取り消しました！";
        return back()->with('flash_msg',$flash_msg);

    }
}
