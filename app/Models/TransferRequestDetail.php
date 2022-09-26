<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferRequestDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transferRequest()
    {
        return $this->belongsTo(TransferRequest::class);
    }

    public function profit()
    {
        return $this->belongsTo(Profit::class);
    }

}
