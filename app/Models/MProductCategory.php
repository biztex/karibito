<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [ 'id' ];

    // MProductChildCategoriesモデルとのリレーション
    public function mProductChildCategory()
    {
        return $this->hasMany(MProductChildCategory::class, 'parent_category_id');
    }
}
