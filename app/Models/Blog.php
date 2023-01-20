<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    protected $guarded = ['id'];

   /**
    * ユーザー
    *
    * @return BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 商品
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * ブログの添付画像
     *
     * @return HasMany
     */
    public function blogImage(): HasMany
    {
        return $this->hasMany(BlogImage::class);
    }
    
    /**
     * 退会していないユーザーのブログ取得
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublish($query): Builder
    {
        return $query->has('user')->notBan();
    }

    /**
     * 制限されているユーザーの商品以外を取得
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotBan($query): Builder
    {
        $ban_user_ids = UserProfile::where('is_ban', 1)->pluck('id')->toArray();

        return $query->where('user_id', "!=", $ban_user_ids);
    }
}
