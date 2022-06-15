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

    const NOT_DRAFT = 0;
    const IS_DRAFT = 1;
    const DRAFT_STATUS = [
        self::NOT_DRAFT => '下書きでない',
        self::IS_DRAFT => '下書き',
    ];

    const CALL_POSSIBLE = 0;
    const CALL_INPOSSIBLE = 1;
    const IS_CALL = [
        self::CALL_POSSIBLE => 'あり',
        self::CALL_INPOSSIBLE => 'なし',
    ];

    const ONLINE = 0;
    const OFFLINE = 1;
    const IS_ONLINE = [
        self::ONLINE => '非対面',
        self::OFFLINE => '対面',
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

    // Prefectureモデルとのリレーション
    public function prefecture()
    {
        return $this->belongsTo(JobRequest::class);
    }
}
