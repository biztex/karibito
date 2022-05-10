<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;


    protected $fillable = [
        'first_name',
        'last_name',
        'prefecture',
        'user_id',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    const GENDER_MAN = 1;
    const GENDER_WOMAN = 2;

    const GENDER = [
        self::GENDER_MAN => '男性',
        self::GENDER_WOMAN => '女性',
    ];
}
