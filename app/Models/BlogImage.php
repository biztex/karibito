<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_images';

    protected $guarded = ['id'];

    /**
     * ブログ
     *
     * @return BelongsTo
     */
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
