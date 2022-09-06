<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use App\Mail\User\IdentificationUploadMail;
use App\Models\Specialty;
use App\Http\Requests\UserProfile\StoreRequest;
use Carbon\Carbon;

class UserProfileService
{
    /**
     * ニックネーム変更
     */
    public function updateUser($params)
    {
        $user = \Auth::user();
        $user->fill([ 'name' => $params['name'] ])->save();
        return $user;
    }

    /**
     * payjp 顧客id保存
     * @param string $customer_id
     * @return void
     */
    public function createPayjpCustomer($customer_id)
    {
        \Auth::user()->fill([
                'payjp_customer_id' => \Crypt::encryptString($customer_id)
            ])->save();
    }

    /**
     * ユーサープロフィール基本情報登録
     */
    public function storeUserProfile(array $params): UserProfile
    {
        $user_profile = UserProfile::updateOrCreate(
            ['user_id' => \Auth::id()],
            [
                'first_name' => $params['first_name'],
                'last_name' => $params['last_name'],
                'gender' => $params['gender'],
                'prefecture_id' => $params['prefecture'],
            ],
        );

        \DB::table('user_notification_settings')->insert([
            [
                'user_id' => \Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        return $user_profile;
    }

    /**
     * ユーサープロフィール編集
     */
    public function updateUserProfile($request)
    {
        if ( $request->year == null || $request->month == null || $request->day == null ){
            $birthday = null;
        } else {
            $birthday = $request->year . '-' . $request->month . '-' . $request->day;
        }
        $user_profile = \Auth::user()->userProfile;

        $user_profile->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'prefecture_id' => $request->prefecture,
            'birthday' => $birthday,
            'zip' => $request->zip,
            'address' => $request->address,
            'introduction' => $request->introduction,
        ]);
        return $user_profile->save();
    }

    /**
     * 身分証明証提出
     */
    public function updateIdentification($request)
    {
        $user_profile = \Auth::user()->userProfile;
        $user_profile->identification_path = $request->file('identification_path')->store('identification_paths','public');
        $user_profile->save();

        \Mail::send(new IdentificationUploadMail());
    }


    /**
     * ユーサープロフィール
     * カバー・アイコン画像変更・登録
     */
    public function updateUserProfileImage($request,$value)
    {
        $user_profile = \Auth::user()->userProfile;

        $old = $user_profile->$value;

        if(isset($request->$value)){
            $user_profile->$value = $request->file($value)->store($value . 's','public');

            if(null !== $old){
                \Storage::delete('public/' . $old);
            }
        }
        return $user_profile->save();
    }

    /**
     * カバー・アイコン画像削除
     */
    public function deleteUserProfileImage($value)
    {
        $user_profile = \Auth::user()->userProfile;

        $old = $user_profile->$value;
        $user_profile->$value = null;

        if(null !== $old){
            \Storage::delete('public/' . $old);
        }
        return $user_profile->save();
    }

    /**
     * ユーザーの電話番号変更
     * @param User $user
     * @param string $new_tel
     * @return User
     */
    public function updateTel(User $user, string $new_tel): User
    {
        $user->tel = $new_tel;
        $user->save();
        return $user;
    }

    /**
     * 得意分野登録
     */
    public function updateSpecialty(array $request)
    {
        \Auth::user()->specialty()->delete();
        if(isset($request['profile_content'])){
            foreach($request['profile_content'] as $value){
                if($value !== null){
                    $content = ['profile_content' => $value];
                    \Auth::user()->specialty()->create($content);
                }
            }
        }
    }

    public function updateCanCall(array $request)
    {
        \Auth::user()->userProfile->fill(['can_call' => $request['can_call']])->save();
    }
}