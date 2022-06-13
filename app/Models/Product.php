<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    // additonalOptionsモデルとのリレーション
    public function additionalOptions()
    {
        return $this->hasMany(AdditionalOption::class, 'product_id');
    }

    // productQuestionモデルとのリレーション
    public function productQuestion()
    {
        return $this->hasMany(ProductQuestion::class, 'product_id');
    }
}
