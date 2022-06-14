<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const ONLINE = 0;
    const OFFLINE = 1;

    const IS_ONLINE = [
        self::ONLINE => '対面',
        self::OFFLINE => '非対面',
    ];

    const ON_CALL = 0;
    const OFF_CALL = 1;

    const IS_CALL = [
        self::ON_CALL => 'あり',
        self::OFF_CALL => 'なし',
    ];

    const ONE_OF_SALE = 1;
    const UNLIMITED_ON_SALE = 99;

    const NUMBER_OF_SALE = [
        self::ONE_OF_SALE => '一人様限定',
        self::UNLIMITED_ON_SALE => '無制限',
    ];

    // AdditionalOptionモデルとのリレーション
    public function additionalOptions()
    {
        return $this->hasMany(AdditionalOption::class, 'product_id');
    }

    // ProductQuestionモデルとのリレーション
    public function productQuestions()
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
