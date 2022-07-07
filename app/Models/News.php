<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_PRIVATE = 0;
    const STATUS_PUBLISH = 1;

    const PUBLIC_STATUS = [
        self::STATUS_PRIVATE => '非公開',
        self::STATUS_PUBLISH => '公開',
    ];
}
