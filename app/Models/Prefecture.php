<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    
    protected $guarded = [ 'id' ];

    // UserProfileモデルとのリレーション
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    // JobRequestモデルとのリレーション
    public function jobRequest()
    {
        return $this->hasMany(JobRequest::class);
    }
}
