<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    const STATUS_PUBLISH = 1;

    const STATUS_PRIVATE = 2;

    const SALES_STATUS = [
        self::STATUS_PUBLISH => '公開',
        self::STATUS_PRIVATE => '非公開',
    ];

    const OFFLINE = 0;

    const ONLINE = 1;

    const IS_ONLINE = [
        self::OFFLINE => '対面',
        self::ONLINE => '非対面',
    ];

    const OFF_CALL = 0;

    const ON_CALL = 1;

    const IS_CALL = [
        self::OFF_CALL => 'なし',
        self::ON_CALL => 'あり',
    ];

    const ONE_OF_SALE = 0;

    const UNLIMITED_OF_SALE = 99;

    const NUMBER_OF_SALE = [
        self::ONE_OF_SALE => '1人様限定',
        self::UNLIMITED_OF_SALE => '無制限',
    ];

    const NOT_DRAFT = 0;

    const IS_DRAFT = 1;

    const DRAFT_STATUS = [
        self::NOT_DRAFT => '下書きでない',
        self::IS_DRAFT => '下書き',
    ];


    /**
     * 制限されているユーザーの商品以外を取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotBan($query)
    {
        $ban_user_ids = User::where('is_ban' ,1)->pluck('id')->toArray();;

        return $query->where('user_id', "!=", $ban_user_ids);
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
     * 自分以外の提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOtherUsers($query)
    {
        return $query->where('user_id','<>', \Auth::id());
    }

    /**
     * 特定ユーザーの提供のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetUser($query, $user)
    {
        return $query->publish()->where('user_id', $user);
    }

    /**
     * 公開かつ下書きでない
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublish($query)
    {
        return $query->notDraft()->notBan()->where('status',Product::STATUS_PUBLISH);
    }

    /**
     * 下書きのみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('is_draft', Product::IS_DRAFT);
    }

    /**
     * 下書き以外のみ取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDraft($query)
    {
        return $query->where('is_draft', Product::NOT_DRAFT);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function additionalOption()
    {
        return $this->hasMany(AdditionalOption::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productQuestion()
    {
        return $this->hasMany(ProductQuestion::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mProductChildCategory()
    {
        return $this->hasOne(MProductChildCategory::class, 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productChatroom()
    {
        return $this->hasMany(ProductChatroom::class);
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
}
