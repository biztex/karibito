<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS = [
        1 => 'チャット開始',
        2 => '契約',
        3 => '作業',
        4 => '購入者評価',
        5 => '出品者評価',
        6 => '完了',
        7 => 'キャンセル'
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
        return $query->whereIn('status', [1,2,3,4,5]);
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
        return $query->whereIn('status', [6,7]);
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
     * キャンセル申請可能ステータス
     * 
     */
    public function isCancelRequest()
    {
        if ($this->status === 3 || $this->status === 4) {
            return true;
        }
        return false;
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
    public function chatroomMessage()
    {
        return $this->hasMany(ChatroomMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposal()
    {
        return $this->hasOne(Proposal::class);
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
    public function evaluation()
    {
        return $this->hasMany(Evaluation::class);
    }   
}
