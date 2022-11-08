<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dmroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dmroomMessages()
    {
        return $this->hasMany(DmroomMessage::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function userNotifications()
    {
        return $this->morphMany(UserNotification::class, 'reference');
    }
}
