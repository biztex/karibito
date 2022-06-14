<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProductChildCategory extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    // ProductChildCategoriesモデルとのリレーション
    public function mProductCategory()
    {
        return $this->belongsTo(MProductCategory::class, 'parent_category_id');
    }
}
