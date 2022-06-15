<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;

    const STATUS_PUBLISH = 1;
    const STATUS_PRIVATE = 2;

    const SALES_STATUS = [
        self::STATUS_PUBLISH => '公開',
        self::STATUS_PRIVATE => '非公開',
    ];

    const IS_DRAFT = 0;
    const NOT_DRAFT = 1;
    const DRAFT_STATUS = [
        self::IS_DRAFT => '下書き',
        self::NOT_DRAFT => '下書きでない',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [ 'id' ];

    // MProductChildCategoryモデルとのリレーション
    public function mProductChildCategory()
    {
        return $this->belongsTo(MProductChildCategory::class,'category_id');
    }

    // Userモデルとのリレーション
    public function user()
    {
        return $this->belongsTo(JobRequest::class);
    }
}
