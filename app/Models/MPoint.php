<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPoint extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    // const NEW_REGISTRATION = 1;
    // const FIRST_EXHIBITION = 2;
    // 注意、仕様を変えられる可能性がある
    const TRANSACTION_COMPLETED = 1;
    const PRODUCT_REGISTRATION = 2;
    const INVITED_FRIEND = 3;
    const PERSONAL_AUTHENTICATION = 4;
}
