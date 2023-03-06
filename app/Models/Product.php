<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $appends = ['number_of_sold'];

    const STATUS_PUBLISH = 1;

    const STATUS_PRIVATE = 2;

    const SALES_STATUS = [
        self::STATUS_PUBLISH => '公開',
        self::STATUS_PRIVATE => '非公開',
    ];

    const OFFLINE = 0;

    const ONLINE = 1;

    const EITHER = 2;

    const IS_ONLINE = [
        self::OFFLINE => '対面',
        self::ONLINE => '非対面',
        self::EITHER => 'どちらでも',
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


    protected function getNumberOfSoldAttribute()
    {
        return Chatroom::numberOfSold($this->id);
    }

    /**
     * 売り切れている商品のステータス
     *
     * @return boolean
     */
    public function getProductSoldStatus()
    {
        return $this->user_id !== \Auth::id() && $this->number_of_sale === $this::ONE_OF_SALE && Chatroom::numberOfSold($this->id) !== 0;
    }
    /**
     * 制限されているユーザーの商品以外を取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotBan($query)
    {
        $ban_user_ids = UserProfile::where('is_ban' ,1)->pluck('id')->toArray();

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
        return $query->publish()->where('user_id','<>', \Auth::id());
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
     * 特定ユーザーの提供、かつ今表示されていないものを取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetUserOtherProduct($query, $user, $product_id)
    {
        return $query->publish()->where('user_id', $user)->where('id', '<>', $product_id);
    }

    /**
     * 退会していないかつ、公開かつ、下書きでない
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublish($query)
    {
        return $query->has('user')->notDraft()->notBan()->where('status',Product::STATUS_PUBLISH);
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
    public function productLink()
    {
        return $this->hasMany(ProductYoutubeLink::class, 'product_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasedProduct()
    {
        return $this->hasMany(PurchasedProduct::class, 'product_id');
    }

    /**
     * ブログ
     * 
     * @return HasMany
     */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function userNotifications()
    {
        return $this->morphMany(UserNotification::class, 'reference');
    }

    /**
     * 投稿条件を満たしているかどうかを判別する
     * 
     * @return bool
     */
    public function isPost()
    {
        $isPost = true;
        // データ生成
        $product = $this->toArray();
        if (collect($this->additionalOption)->isNotEmpty()) {
            foreach($this->additionalOption as $additional_option) {
                $product['option_name'][] = $additional_option->name;
                $product['option_price'][] = $additional_option->price;
                $product['option_is_public'][] = $additional_option->is_public;
            }
        }
        if (collect($this->productQuestion)->isNotEmpty()) {
            foreach($this->productQuestion as $product_question) {
                $product['question_title'][] = $product_question->title;
                $product['answer'][] = $product_question->answer;
            }
        }
        if (collect($this->productLink)->isNotEmpty()) {
            foreach($this->productLink as $link) {
                $product['youtube_link'][] = $link->youtube_link;
            }
        }
        for ($i = 0; $i < 10; $i++) {
            if(isset($this->productImage[$i])) {
                $product['base64_text'][] = '#';
                $product['old_image'][] = $this->productImage[$i]->path;
            } else {
                $product['base64_text'][] = '';
                $product['old_image'][] = '';
            }
            $product['image_status' . $i] = null;
        }
        $product['status'] = $this->status;
        // バリデーション
        $validator = Validator::make($product, [
            'category_id' => 'required | integer | exists:m_product_child_categories,id',
            'prefecture_id' => 'required_if:is_online,0,2 | nullable | between:1,47',
            'title' => 'required | string | max:30',
            'content' => 'required | string | min:30 | max:3000 ',
            'price' => 'required | integer | min:500 | max:9990000',
            'is_online' => 'required | in:0,1,2',
            'number_of_day' => 'required | integer | between:1,730',
            'time_unit' => 'required | integer',
            // 'is_call' => 'required | boolean',　電話対応は仕様変更によって一旦非表示
            'number_of_sale' => 'required | integer',
            'status' => 'required | integer',
            'option_name.*' => 'nullable | string | max:400',
            'option_price.*' => 'nullable | integer',
            'option_is_public.*' => 'integer',
            'question_title.*' => 'required_unless:answer.*,null| max:400',
            'answer.*' => 'required_unless:question_title.*,null| max:400',
            'youtube_link.*' => 'nullable | string | max:255 | url',
            'base64_text.0' => 'required',
            'paths.*' => 'max:20480 | file | image | mimes:png,jpg'
        ]);
        if ($validator->fails()) {
            $isPost = false;
        }
        return $isPost;
    }
}
