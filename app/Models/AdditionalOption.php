<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalOption extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    const OPTION_PRICE = [
        0 => '500',
        1 => '1000',
        2 => '1500',
        3 => '2000',
        4 => '2500',
        5 => '3000',
        6 => '3500',
        7 => '4000',
        8 => '4500',
        9 => '5000',
        10 => '5500'
    ];

    const NOT_PUBLIC = 0;
    const IS_PUBLIC = 1;
    const PUBLIC_STATUS = [
        self::NOT_PUBLIC => '非公開',
        self::IS_PUBLIC => '公開',
    ];
}

