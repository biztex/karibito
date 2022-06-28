<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMailHistory extends Model
{
    use HasFactory;

    public const TYPE_ZERO= 0; //仮名
    public const TYPE_ONE = 1; //仮名
    public const TYPE_TWO = 2; //仮名

    public const BOOKING_TYPES = [
        self::TYPE_ZERO => 'タイプ0',
        self::TYPE_ONE => 'タイプ1',
        self::TYPE_TWO => 'タイプ2'
    ];

    protected $guarded = array('id');
}
