<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCoupon extends Model
{
    use HasFactory;

    // クーポン種別
    const QUESTIONNAIRE_ANSWER = 1;
    const NEW_REGISTRATION = 2;
    const INVITED_FRIEND = 3;

    protected $guarded = [ 'id' ];
}
