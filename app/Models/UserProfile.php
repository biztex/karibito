<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserProfile extends Model
{
    use HasFactory;
    
    protected $guarded = [ 'id' ];

<<<<<<< Updated upstream
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'prefecture',
        'birthday',
        'zip',
        'address',
        'introduction',
        'icon',
        'cover'
    ];
=======

    const GENDER_MAN = 1;
    const GENDER_WOMAN = 2;

    const GENDER = [
        self::GENDER_MAN => '男性',
        self::GENDER_WOMAN => '女性',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }


>>>>>>> Stashed changes
}
