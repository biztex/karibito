<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use App\Libraries\DiffDateTime;


class JobRequest extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [ 'id' ];

    protected $appends = ['diff_time'];

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


    // 表示するもののみのスコープを作成する

    /**
     * 自分の提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisplay($query)
    {
        // return $query->inDeadline()->otherUsers(); 現段階では期限切れも表示するため一旦非表示
        return $query->otherUsers();
    }

    /**
     * 制限されているユーザーの商品以外を取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotBan($query)
    {
        $ban_user_ids = UserProfile::where('is_ban' ,1)->pluck('user_id')->toArray();;

        return $query->where('user_id', "!=", $ban_user_ids);
    }

    /**
     * 自分の提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInDeadline($query)
    {
        return $query->where('application_deadline', ">=", today());
    }

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
     * 自分の以外の提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOtherUsers($query)
    {
        return $query->publish()->where('user_id','<>',\Auth::id());
    }

    /**
     * 特定ユーザーの提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetUser($query, $user)
    {
        return $query->where('user_id', $user);
    }

    /**
     * 公開かつ下書きでない
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublish($query)
    {
        return $query->notDraft()->notBan()->where('status',self::STATUS_PUBLISH);
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
    public function chatrooms()
    {
        return $this->morphMany(Chatroom::class, 'reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function karibitoSurvey()
    {
        return $this->morphMany(KaribitoSurvey::class, 'reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function points()
    {
        return $this->morphMany(UserGetPoint::class, 'reference');
    }

    protected function getDiffTimeAttribute()
    {
        $date = new Carbon($this->application_deadline);
        return $this->attributes['diff_time'] = $date->addDay()->diffForHumans(Carbon::now());
    }
}
