<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    // フォロー済みユーザー
    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_user_id');
    }

    // フォローしたユーザー
    public function followedUser()
    {
        return $this->belongsTo(User::class, 'followed_user_id');
    }

    // フォローされているかのチェック
    public function scopeIsFollowing($query, $id)
    {
        return $query->where('following_user_id', $id)
                    ->where('followed_user_id', \Auth::user()->id)->exists();
    }

    // フォロワーを取得
    public function scopeGetFollowing($query, $id)
    {
        return $query->where('following_user_id', $id)
                    ->where('followed_user_id', \Auth::user()->id);
    }
}
