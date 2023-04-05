<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // 対象ユーザーの支払い
    public function scopeTargetUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    // 対象ユーザーの返金
    public function scopeTargetUserRefund($query, $user_id)
    {
        return $query->targetUser($user_id)->where('refunded_at', "!=", null);
    }

    // 返金以外
    public function scopeNotRefunded($query)
    {
        return $query->where('amount_refunded', null);
    }    

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
