<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }


    public function authGoogleCallback()
    {
        $google_user = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $google_user->id)->first();
        // $user = User::where('email', $google_user->email)->first();
        // dd($user);
        if ($user){
            Auth::login($user);
            return redirect()->route('mypage.showMypage');
        } else {
            // $user = User::where('google_id', $google_user->id)->first();
            $duplicate_email_user = User::where('email', $google_user->email)->first();
            dd($duplicate_email_user);
            if($duplicate_email_user) {
                // if(is_null($duplicate_email_user->email_verified_at)) {
                //     $duplicate_email_user->email_verified_at = Carbon::now();
                // }

                $duplicate_email_user->google_id = $google_user->id;
                $duplicate_email_user->save();
            } else {
                $user = User::create([
                    'email' => $google_user->email,
                    'google_id' => $google_user->id,
                    // 'email_verified_at' => Carbon::now()
                ]);
            }
                    Auth::login($duplicate_email_user);
                    return redirect()->route('user_profile.create');
                // Auth::login($user, true);
            }
        }

        /**
     * GoogleもしくはFacebook登録
     *
     * メールアドレス登録や各SNSで登録などで、同じメールアドレスで既に登録している場合
     * 同じユーザーとみなし各SNS経由でのログインも可能にする
     *
     * 「レコード作成」もしくは「レコード更新（emailが一致するレコードがある時）」
     *
    //  * @param string $provider
    //  * @param string $providerId
    //  * @param string $providerUserName
    //  * @param string $providerUserEmail
    //  * @param string $providerUserAvatar
    //  * @return Illuminate\Http\RedirectResponse
    //  */
    // protected function register(
    //     $provider,
    //     $providerId,
    //     $providerUserName,
    //     $providerUserEmail,
    //     $providerUserAvatar
    // ) {
    //     // メールアドレスが重複したユーザー
    //     $user = User::where('email', $google_user->email)->first();

    //     $facebook_email_user = User::whereEmail($user)->first();

    //     /**
    //      * もしメールアドレスが重複したユーザーがいれば、そのレコードにgoogle_idもしくはtwitter_idを挿入しログイン
    //      * その際メールアドレスが重複したユーザーがメールアドレス確認を完了してない場合は
    //      * このタイミングでemail_verified_atに時刻を挿入し、確認完了とする
    //      *
    //      * いなければ、ユーザー作成
    //      */
    //     if ($duplicateEmailUser) {
    //         if ($duplicateEmailUser->email_verified_at) {
    //             $duplicateEmailUser->update([$provider . '_id' => $providerId]);
    //         } else {
    //             $duplicateEmailUser->update([
    //                 $provider . '_id' => $providerId,
    //                 'email_verified_at' => Carbon::now(),
    //             ]);
    //         }
    //         \Auth::login($duplicateEmailUser);
    //     } else {
    //         // 画像の保存、画像URLが取得できなかった時の対策でile_get_contentsの前に@をつけている
    //         $img = @file_get_contents($providerUserAvatar);
    //         $fileName = null;
    //         if ($img !== false) {
    //             $fileName = 'public/icon/' . $providerId . '_' . uniqid() . '.jpg';
    //             \Storage::put($fileName, $img, 'public');
    //         }
    //         \Auth::login(User::firstOrCreate([
    //             $provider . '_id' => $providerId
    //         ], [
    //             'name' => $providerUserName,
    //             'email' => $providerUserEmail,
    //             'icon' => $fileName,
    //             'email_verified_at' => Carbon::now(),
    //         ]));
    //     }
    //     Log::info('[' . $provider . ']新規登録Eメール:'.$providerUserEmail);
    //     return redirect($this->redirectTo);
    // }
}