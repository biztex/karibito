<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Prefecture;
use App\Libraries\Age;
use App\Services\AdminUserSearchService;
use App\Mail\Admin\NotifyBanMail;
use App\Mail\Admin\CancelNotifyBanMail;

class UserController extends Controller
{
    private $user_search;

    public function __construct(AdminUserSearchService $user_search)
    {
        $this->user_search = $user_search;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {

        $users = UserProfile::orderBy('id', 'desc')->paginate(50);

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
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $user = UserProfile::with(['user', 'prefecture'])->firstWhere('user_id', $id);

        return view('admin.user.show',compact('user'));
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
     */
    public function revokeApproval($id)
    {
        $user = UserProfile::firstWhere('user_id',$id);
        $user->fill(['is_identify' => 0])->save();

        $flash_msg = "id:" . $user->user_id . " " . $user->first_name . $user->last_name . "さんの本人確認の承認を取り消しました！";
        return back()->with('flash_msg',$flash_msg);

    }

    /**
     * 利用制限をする
     */
    public function limitAccount($id)
    {
        $user_profile = UserProfile::firstWhere('id',$id);

        $user_profile->fill([
            'is_ban' => 1,
            'is_banned_at' => now()
        ])->save();

        $flash_msg = "id:" . $user_profile->user_id . " " . $user_profile->first_name . $user_profile->last_name . "さんの利用を制限しました！";

        \Mail::to($user_profile->user->email)->send(new NotifyBanMail($user_profile));

        return back()->with('flash_msg',$flash_msg);
    }

    /**
     * 利用制限を解除する
     */
    public function cancelLimitAccount($id)
    {
        $user_profile = UserProfile::firstWhere('id',$id);

        $user_profile->fill(['is_ban' => 0])->save();

        $flash_msg = "id:" . $user_profile->user_id . " " . $user_profile->first_name . $user_profile->last_name . "さんの利用制限を解除しました！";

        \Mail::to($user_profile->user->email)->send(new CancelNotifyBanMail($user_profile));

        return back()->with('flash_msg',$flash_msg);
    }

    /**
     * ユーザー検索
     */
    public function search(Request $request)
    {
        $users = $this->user_search->searchUser($request);

        return  view('admin.user.index', compact('users', 'request'));
    }

    /**
     * メモを更新する
     */
    public function updateMemo(Request $request, $id)
    {
        $request->validate([
            'memo' => 'nullable|string|max:255',
        ]);
        $user = User::findOrFail($id);
        $user->memo = $request->memo;
        $user->save();

        return back()->with('status', 'メモを変更しました');
    }
}
