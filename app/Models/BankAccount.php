<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    const TYPE_ORDINARY = 1;
    const TYPE_CURRENT = 2;

    const BANK_TYPE = [
        self::TYPE_ORDINARY => '普通',
        self::TYPE_CURRENT => '当座',
    ];
}
