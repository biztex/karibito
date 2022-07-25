<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    /**
     * キャンセル申請可能状況判断
     * @return bool
     */
    public function isCancelable(): bool
    {
        if ($this->purchasedCancel->isEmpty()){
            return true;
        } elseif ($this->purchasedCancel->sortBy('updated_at')->last()->status === PurchasedCancel::STATUS_OBJECTION){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function chatroomMessage()
    {
        return $this->morphOne(ChatroomMessage::class, 'reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buyerUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasedCancel()
    {
        return $this->hasMany(PurchasedCancel::class);
    }

}
