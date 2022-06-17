<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

    const NOT_PUBLIC = 1;
    const IS_PUBLIC = 2;

    const PUBLIC_STATUS = [
        self::NOT_PUBLIC => '非公開',
        self::IS_PUBLIC => '公開',
    ];


    // AdditionalOptionモデルとのリレーション
    public function additionalOption()
    {
        return $this->hasMany(AdditionalOption::class, 'product_id');
    }

    // ProductQuestionモデルとのリレーション
    public function productQuestion()
    {
        return $this->hasMany(ProductQuestion::class, 'product_id');
    }

    // MProductChildCategoryモデルとのリレーション
    public function mProductChildCategory()
    {
        return $this->hasOne(MProductChildCategory::class, 'id', 'category_id');
    }

    // Prefectureモデルとのリレーション
    public function productPrefecture()
    {
        return $this->hasOne(Prefecture::class, 'id');
    }

    // Userモデルとのリレーション
    public function productUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
