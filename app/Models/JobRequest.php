<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Libraries\DiffDateTime;


class JobRequest extends Model
{
    use HasFactory, SoftDeletes;

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

    const CALL_INPOSSIBLE = 0;

    const CALL_POSSIBLE = 1;
    
    const IS_CALL = [
        self::CALL_POSSIBLE => 'あり',
        self::CALL_INPOSSIBLE => 'なし',
    ];

    const OFFLINE = 0;

    const ONLINE = 1;

    const IS_ONLINE = [
        self::ONLINE => '非対面',
        self::OFFLINE => '対面',
    ];

    /**
     * 自分の提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoginUsers($query)
    {
        return $query->where('user_id',\Auth::id());
    }

    /**
     * 公開かつ下書きでない
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublish($query)
    {
        return $query->notDraft()->where('status',self::STATUS_PUBLISH);
    }

    /**
     * 下書きのみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('is_draft', JobRequest::IS_DRAFT);
    }

    /**
     * 下書き以外のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDraft($query)
    {
        return $query->where('is_draft', JobRequest::NOT_DRAFT);
    }

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
        return $this->belongsTo(User::class);
    }

    // Prefectureモデルとのリレーション
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobRequestChatroom()
    {
        return $this->hasMany(JobRequestChatroom::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function chatroom()
    {
        return $this->morphMany(Chatroom::class, 'reference');
    }

    /**
     * 締切まで後何日を取得
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function deadlineDay(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $day1 = now();
                $day2 = $attributes['application_deadline'];
                $diff_date_time = DiffDateTime::diff_date_time($day1, $day2);

                return $diff_date_time['days'];
        }
        );
    }

    /**
     * * 締切まで後何日かを取得
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function deadlineHour(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
            $day1 = now();
            $day2 = $attributes['application_deadline'];
            $diff_date_time = DiffDateTime::diff_date_time($day1, $day2);

            return $diff_date_time['hours'];
            }
        );
    }
}
