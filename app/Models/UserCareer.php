<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCareer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['first','last'];

    protected function getFirstAttribute()
    {
        return $this->first_year.'年'.$this->first_month.'月';
    }

    protected function getLastAttribute()
    {
        return $this->last_year.'年'.$this->last_month.'月';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetUser($query, $user)
    {
        return $query->where('user_id', $user);
    }
}