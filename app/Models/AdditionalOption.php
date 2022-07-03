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

    const STATUS_PUBLISH = 1;
    const STATUS_PRIVATE = 2;

    const PUBLIC_STATUS = [
        self::STATUS_PUBLISH => '公開',
        self::STATUS_PRIVATE => '非公開',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

