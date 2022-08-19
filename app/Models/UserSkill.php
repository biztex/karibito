<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * 自分のスキルのみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoginUsers($query)
    {
        return $query->where('user_id',\Auth::id());
    }

    public function scopeGetUser($query, $user)
    {
        return $query->where('user_id', $user);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}