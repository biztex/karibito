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

    const IS_IDENTIFY = 1;

    const NOT_IDENTIFY = 0;
    
    const IDENTIFY = [
        self::IS_IDENTIFY =>'承認済',
        self::NOT_IDENTIFY =>'未',
    ];
    
    protected function getBirthdayAttribute($birthday)
    {
        $day = date("Ymd",strtotime($birthday));
        
        $birthday = Age::group($day);
        return ucfirst($birthday);
    }

    protected function getBirthdayAttribute($birthday)
    {
        $day = date("Ymd",strtotime($birthday));

        $birthday = Age::group($day);
        return ucfirst($birthday);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
}
