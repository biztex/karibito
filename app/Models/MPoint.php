<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPoint extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    const NEW_REGISTRATION = 1;
    const FIRST_EXHIBITION = 2;
    const TRANSACTION_COMPLETED = 3;
}
