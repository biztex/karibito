<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\AdminUserSearchService;
use App\Mail\Admin\NotifyBanMail;
use App\Mail\Admin\CancelNotifyBanMail;
use App\Mail\User\ApproveMail;
use App\Mail\Admin\RevokeApprovalMail;
use App\Services\UserNotificationService;

class UserController extends Controller
{
    private $user_search;
    private $user_notification_service;

    public function __construct(AdminUserSearchService $user_search, UserNotificationService $user_notification_service)
    {
        $this->user_search = $user_search;
        $this->user_notification_service = $user_notification_service;
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
    public function approve(User $user)
    {
        $user->userProfile->fill(['is_identify' => 1])->save();

        if ($user->sub_email) {
            \Mail::to($user->email)
                ->cc($user->sub_email)
                ->send(new ApproveMail($user));
        } else {
            \Mail::to($user->email)
                ->send(new ApproveMail($user));
        }
        $flash_msg = "id:" . $user->id . " " . $user->userProfile->full_name . "さんの本人確認を承認しました！";
        return back()->with('flash_msg',$flash_msg);
    }

    /**
     * 身分証明証の承認を取り消す
     */
    public function revokeApproval(User $user)
    {
        $user->userProfile->fill(['is_identify' => 0])->save();

        $flash_msg = "id:" . $user->id . " " . $user->userProfile->full_name . "さんの本人確認の承認を取り消しました！";

        if ($user->sub_email) {
            \Mail::to($user->email)
                ->cc($user->sub_email)
                ->send(new RevokeApprovalMail($user));
        } else {
            \Mail::to($user->email)
                ->send(new RevokeApprovalMail($user));
        }
        
        $user->userProfile->identification_path = null;
        $user->userProfile->save();
        // キャンセル通知
        $this->user_notification_service->storeUserNotificationCancelIdentify($user->userProfile);

        return back()->with('flash_msg',$flash_msg);

    }

    /**
     * 利用制限をする
     */
    public function limitAccount(User $user)
    {
        $user->userProfile->fill([
            'is_ban' => 1,
            'is_banned_at' => now()
        ])->save();

        if ($user->sub_email) {
            \Mail::to($user->email)
                ->cc($user->sub_email)
                ->send(new NotifyBanMail($user->userProfile));
        } else {
            \Mail::to($user->email)
                ->send(new NotifyBanMail($user->userProfile));
        }

        $flash_msg = "id:" . $user->id . " " . $user->userProfile->full_name . "さんの利用を制限しました！";
        return back()->with('flash_msg',$flash_msg);
    }

    /**
     * 利用制限を解除する
     */
    public function cancelLimitAccount(User $user)
    {
        $user->userProfile->fill(['is_ban' => 0])->save();

        if ($user->sub_email) {
            \Mail::to($user->email)
                ->cc($user->sub_email)
                ->send(new CancelNotifyBanMail($user->userProfile));
            } else {
            \Mail::to($user->email)
                ->send(new CancelNotifyBanMail($user->userProfile));
        }

        $flash_msg = "id:" . $user->id . " " . $user->userProfile->full_name . "さんの利用制限を解除しました！";
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
