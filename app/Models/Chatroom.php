<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    /**
     * 進行中のやりとり
     * status キャンセル・完了以外
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', [self::STATUS_START, self::STATUS_PROPOSAL, self::STATUS_WORK, self::STATUS_BUYER_EVALUATION, self::STATUS_SELLER_EVALUATION]);
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
        return $query->whereIn('status', [self::STATUS_COMPLETE, self::STATUS_CANCELED]);
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

    /**
     * キャンセル申請可能判断
     * @return bool
     */
    public function isCancelable(): bool
    {
        if($this->purchase === null || !in_array($this->status, [self::STATUS_WORK, self::STATUS_BUYER_EVALUATION])) return false;
        
        return $this->purchase->isCancelable();
    }

    /**
     * キャンセル申請可能判断
     * @return bool
     */
    public function canCall(): bool
    {
        return in_array($this->status, [self::STATUS_WORK, self::STATUS_BUYER_EVALUATION]) ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reference()
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function sellerUser()
    {
        return $this->belongsTo(User::class, 'seller_user_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function buyerUser()
    {
        return $this->belongsTo(User::class, 'buyer_user_id');
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
}
