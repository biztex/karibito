<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

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
}
