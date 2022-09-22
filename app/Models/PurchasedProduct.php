<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasedProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [ 'id' ];

    // MProductChildCategoryモデルとのリレーション
    public function mProductChildCategory()
    {
        return $this->belongsTo(MProductChildCategory::class,'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasedAdditionalOption()
    {
        return $this->hasMany(PurchasedAdditionalOption::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasedProductQuestion()
    {
        return $this->hasMany(PurchasedProductQuestion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasedProductLink()
    {
        return $this->hasMany(PurchasedProductYoutubeLink::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasedProductImage()
    {
        return $this->hasMany(PurchasedProductImage::class);
    }
}
