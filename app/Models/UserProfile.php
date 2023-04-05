<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Age;

class UserProfile extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [ 'id' ];

    const GENDER_MAN = 1;

    const GENDER_WOMAN = 2;

    const GENDER = [
        self::GENDER_MAN => '男性',
        self::GENDER_WOMAN => '女性',
    ];

    const IS_REJECT_IDENTIFY = 2;

    const IS_IDENTIFY = 1;

    const NOT_IDENTIFY = 0;

    const IDENTIFY = [
        self::IS_REJECT_IDENTIFY =>'申請却下',
        self::IS_IDENTIFY =>'承認済',
        self::NOT_IDENTIFY =>'未',
    ];

    const CAN_CALL = 1;

    const CANNOT_CALL = 0;
    
    const CALL_STATUS = [
        self::CAN_CALL => '待機中',
        self::CANNOT_CALL => '対応不可'
    ];

    const NOT_BAN = 0;

    const IS_BAN = 1;

    const BAN = [
        self::IS_BAN => '制限あり',
        self::NOT_BAN => '制限なし',
    ];

    const RESIZE_WIDTH_ICON = 350;
    const RESIZE_WIDTH_COVER = 720;
    const RESIZE_WIDTH_IDENTIFICATION = 720;

    protected $appends = ['age','now_age','full_name'];

    protected function getAgeAttribute()
    {
        return Age::group($this->birthday);
    }

    protected function getNowAgeAttribute()
    {
        return Age::nowAge($this->birthday);
    }

    protected function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
}
