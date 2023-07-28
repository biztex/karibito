<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCoupon extends Model
{
    use HasFactory;

    // クーポン種別
    const NEW_REGISTRATION = 1;
    const QUESTIONNAIRE_ANSWER = 2;
    const ALREADY_REGISTRATION = 3;

    protected $guarded = [ 'id' ];
}
