<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProductCategory extends Model
{
    use HasFactory;

    // ProductChildCategoriesモデルとのリレーション
    public function mProductChildCategory()
    {
        return $this->hasMany(MProductChildCategory::class, 'parent_category_id');
    }
}
