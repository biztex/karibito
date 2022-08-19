<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MCommissionRate extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function scopeNowRate($query)
    {
        return $query->orderBy('effective_datetime', 'desc')->first();
    }
}
