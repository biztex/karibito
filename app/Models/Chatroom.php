<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['to_user_id'];

    const STATUS_START = 1;
    const STATUS_PROPOSAL = 2;
    const STATUS_WORK = 3;
    const STATUS_BUYER_EVALUATION = 4;
    const STATUS_SELLER_EVALUATION = 5;
    const STATUS_COMPLETE = 6;
    const STATUS_CANCELED = 7;

    const STATUS = [
        self::STATUS_START => 'チャット開始',
        self::STATUS_PROPOSAL => '契約',
        self::STATUS_WORK => '作業',
        self::STATUS_BUYER_EVALUATION => '購入者評価',
        self::STATUS_SELLER_EVALUATION => '出品者評価',
        self::STATUS_COMPLETE => '完了',
        self::STATUS_CANCELED => 'キャンセル'
    ];


    protected function getToUserIdAttribute()
    {
        if($this->chatroomMessages->last()->user_id == $this->sellerUser->id)
        {
            return $this->buyer_user_id;
        } else {
            return $this->seller_user_id;
        }
    }

    /**
     * 完了済み販売実績取得
     * 
     * @param int $user_id
     * @return int
     */
    public function getSalesCount(int $user_id): int
    {
        return $this->where('seller_user_id', $user_id)->where('status', self::STATUS_COMPLETE)->count();
    }

    /**
     * キャンセル申請可能判断
     * @return bool
     */
    public function isCancelable(): bool
    {
        if($this->purchase === null || !in_array($this->status, [self::STATUS_WORK])) return false;
        
        return $this->purchase->isCancelable();
    }

    /**
     * 電話対応
     * @return bool
     */
    public function canCall(): bool
    {
        return in_array($this->status, [self::STATUS_WORK, self::STATUS_BUYER_EVALUATION]) ? true : false;
    }

    /**
     * NDA送付表示可能判断
     * 
     * @return bool
     */
    public function isDisplayableNda(): bool
    {
        $is_displayable_nda = true;
        // 身分証明がどちらかが認証されていない場合
        if (empty($this->sellerUser->userProfile->is_identify) || empty($this->buyerUser->userProfile->is_identify)) {
            $is_displayable_nda = false;
        }
        // 身分証明が完了していてもNDAの承認をしていない場合
        if (empty($this->sellerUser->userProfile->is_nda) && empty($this->buyerUser->userProfile->is_nda)) {
            $is_displayable_nda = false;
        }
        return $is_displayable_nda;
    }


    public function scopeNumberOfSold($query, $product_id): int
    {
        return $query->where('reference_type', 'App\Models\Product')
            ->where('reference_id', $product_id)
            ->whereIn('status', [self::STATUS_WORK, self::STATUS_BUYER_EVALUATION, self::STATUS_SELLER_EVALUATION, self::STATUS_COMPLETE, self::STATUS_CANCELED])
            ->count();
    }

    public function scopeRequested($query, $job_request_id): bool
    {
        return $query->where('reference_type', 'App\Models\JobRequest')
            ->where('reference_id', $job_request_id)
            ->whereIn('status', [self::STATUS_WORK, self::STATUS_BUYER_EVALUATION, self::STATUS_SELLER_EVALUATION, self::STATUS_COMPLETE, self::STATUS_CANCELED])
            ->exists();
    }

    /**
     * 進行中のやりとり
     * status キャンセル・完了以外
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->loginUser()->whereIn('status', [self::STATUS_START, self::STATUS_PROPOSAL, self::STATUS_WORK, self::STATUS_BUYER_EVALUATION, self::STATUS_SELLER_EVALUATION]);
    }

    /**
     * 過去のやりとり
     * status キャンセル・完了
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInActive($query)
    {
        return $query->loginUser()->whereIn('status', [self::STATUS_COMPLETE, self::STATUS_CANCELED]);
    }

    /**
     * seller / buyer がログインユーザーである
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoginUser($query)
    {
        return $query->where('seller_user_id', \Auth::id())
                     ->orWhere('buyer_user_id', \Auth::id());
    }

    /**
     * referenceがProduct かつ
     * seller / buyer がログインユーザーである 
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProduct($query)
    {
        return $query->loginUser()->where('reference_type', 'App\Models\Product');
    }

    /**
     * product_idより対象のチャットルームを取得
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTargetProduct($query, $product_id)
    {
        return $query->product()->where('reference_id', $product_id);
    }

     /**
     * job_request_idより対象のチャットルームを取得
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTargetJobRequest($query, $job_request_id)
    {
        return $query->product()->where('reference_id', $job_request_id);
    }

    /**
     * referenceがJobRequest かつ
     * seller / buyer がログインユーザーである 
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJobRequest($query)
    {
        return $query->loginUser()->where('reference_type', 'App\Models\JobRequest');
    }

    // 対象のユーザーが出品者のチャットルーム
    // 入金一覧取得の際に使用
    public function scopeSellService($query, $user_id)
    {
        return $query->loginUser()->where('seller_user_id', $user_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reference()
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function referencePurchased()
    {
        return $this->morphTo(__FUNCTION__, 'purchased_reference_type', 'purchased_reference_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function sellerUser()
    {
        return $this->belongsTo(User::class, 'seller_user_id')->withTrashed();
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function buyerUser()
    {
        return $this->belongsTo(User::class, 'buyer_user_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatroomMessages()
    {
        return $this->hasMany(ChatroomMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatroomNdaMessages()
    {
        return $this->hasMany(ChatroomNdaMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    } 

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }   

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function userNotifications()
    {
        return $this->morphMany(UserNotification::class, 'reference');
    }
}
