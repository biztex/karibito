<?php

namespace App\Services;

use App\Mail\User\GetCouponMail;
use App\Models\UserProfile;
use App\Mail\User\IdentificationUploadMail;
use App\Models\MCoupon;
use App\Models\MPoint;
use App\Services\ImageService;

class UserProfileService
{
    protected $image_service;
    protected $coupon_service;
    protected $point_service;
    
    
    public function __construct(ImageService $image_service, CouponService $coupon_service, PointService $point_service)
    {
        $this->image_service = $image_service;
        $this->coupon_service = $coupon_service;
        $this->point_service = $point_service;
    }

    /**
     * ニックネーム変更
     * @param string $request_name
     */
    public function updateUserName(string $request_name): void
    {
        \Auth::user()->fill([ 'name' => $request_name ])->save();
    }

    /**
     * stripe 顧客id保存
     * @param string $customer_id
     */
    public function fillCustomerId($customer_id): void
    {
        \Auth::user()->fill([ 'stripe_id' => \Crypt::encryptString($customer_id) ])->save();
    }

    /**
     * ユーサープロフィール基本情報登録
     * @param array $params
     */
    public function storeUserProfile(array $params): void
    {
        \DB::beginTransaction();
        try {
            $guest_profile = UserProfile::updateOrCreate(
                ['user_id' => \Auth::id()],
                [
                    'first_name' => $params['first_name'],
                    'last_name' => $params['last_name'],
                    'gender' => $params['gender'],
                    'prefecture_id' => $params['prefecture_id'],
                    'my_code' => \Str::random(11),
                    'friend_code' => $params['friend_code'],
                    'where_know' => $params['where_know']
                ],
            );

            $invitee_profile = UserProfile::where('my_code', $params['friend_code'])->first();

            // 新規会員登録時に登録者にクーポン付与
            $this->coupon_service->createUserCoupon(MCoupon::NEW_REGISTRATION, $guest_profile->user_id);
            // 招待コード入力で紹介者＆招待された人にポイント付与
            if ($invitee_profile && $params['friend_code'] !== null) {
                // ポイント付与
                $this->point_service->getPoint(MPoint::INVITED_FRIEND, $guest_profile->user_id, $invitee_profile);
                $this->point_service->getPoint(MPoint::INVITED_FRIEND, $invitee_profile->user_id, $invitee_profile);
            };

            // 通知設定の作成
            \Auth::user()->userNotificationSetting()->create();

            \DB::commit();
        } catch(\Exception $e){
            \DB::rollBack();
            return;
        };
    }

    /**
     * ユーサープロフィール編集
     * @param array $request
     */
    public function updateUserProfile(array $request): void
    {
        if ( $request['year'] == null || $request['month'] == null || $request['day'] == null ){
            $birthday = null;
        } else {
            $birthday = $request['year'] . '-' . $request['month'] . '-' . $request['day'];
        }

        $is_nda = null;
        if (isset($request['is_nda'])) {
            $is_nda = $request['is_nda']?? 0;
        }
        $user_profile = \Auth::user()->userProfile;

        $user_profile->fill([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'prefecture_id' => $request['prefecture'],
            'birthday' => $birthday,
            'zip' => $request['zip'],
            'address' => $request['address'],
            'address_number' => $request['address_number'],
            'apartment' => $request['apartment'],
            'introduction' => $request['introduction'],
            'is_nda' => $is_nda,
        ]);
        $user_profile->save();
    }

    /**
     * 身分証明証提出
     * @param object $identification_path
     */
    public function updateIdentification($identification_path)
    {
        $user_profile = \Auth::user()->userProfile;
        $user_profile->identification_path = $this->image_service->resizeImage($identification_path, UserProfile::RESIZE_WIDTH_IDENTIFICATION, 'identification_path');
        $user_profile->save();

        if (\Auth::user()->sub_email) {
            \Mail::to(\Auth::user()->email)
                ->cc(\Auth::user()->sub_email)
                ->bcc(config('mail.info_bcc')) //todo:メールトラップでは確認できないため、本番で確認する
                ->send(new IdentificationUploadMail());
        } else {
            \Mail::to(\Auth::user()->email)
                ->bcc(config('mail.info_bcc'))
                ->send(new IdentificationUploadMail());
        }
    }

    /**
     * カバー・アイコン画像変更・登録
     * @param array $request
     * @param string $void : cover / icon
     * @param int $resize_width
     * 
     * @return void
     */
    public function updateUserProfileImage(array $request, string $value, $resize_width): void
    {
        if(isset($request[$value])){
            $this->deleteUserProfileImage($value);
            $resize_file_path = $this->image_service->resizeImage($request[$value], $resize_width, $value);

            $user_profile = \Auth::user()->userProfile;
            $user_profile->$value = $resize_file_path;
            $user_profile->save();
        }
    }

    /**
     * カバー・アイコン画像削除
     * @param string $value : cover / icon
     * 
     * @return void
     */
    public function deleteUserProfileImage(string $value): void
    {
        $user_profile = \Auth::user()->userProfile;

        $old_img = $user_profile->$value;
        $user_profile->$value = null;

        if(null !== $old_img){
            \Storage::delete('public/' . $old_img);
            \Storage::delete('public/original/' . $old_img);
        }
        $user_profile->save();
    }

    /**
     * ユーザーの電話番号変更
     * @param string $new_tel
     */
    public function updateTel(string $new_tel)
    {
        \Auth::user()->fill(['tel' => $new_tel ])->save();
    }

    /**
     * 得意分野登録
     * @param array $contents
     */
    public function updateSpecialty(array $contents): void
    {
        // 一旦すべて削除して入れなおす
        \Auth::user()->specialty()->delete();

        foreach($contents as $content) {
            if($content !== null) {
                \Auth::user()->specialty()->create(['content' => $content]);
            }
        }
    }

    /**
     * 電話対応
     * @param string $can_call
     */
    public function updateCanCall(string $can_call): void
    {
        \Auth::user()->userProfile->fill(['can_call' => $can_call ])->save();
    }

    /**
     * ユーザープロフィールの取得
     * @param int $user_id
     */
    public function getUserProfile(int $user_id)
    {
        return UserProfile::where('user_id', $user_id)->first();
    }
}