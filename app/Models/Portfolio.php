<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    const RESIZE_WIDTH = 720;

    protected $guarded = [ 'id' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mProductChildCategory()
    {
        return $this->hasOne(MProductChildCategory::class, 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolioLink()
    {
        return $this->hasMany(PortfolioYoutubeLink::class, 'portfolio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function userNotifications()
    {
        return $this->morphMany(UserNotification::class, 'reference');
    }
}
