<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MProductChildCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [ 'id' ];

    // ProductChildCategoriesモデルとのリレーション
    public function mProductCategory()
    {
        return $this->belongsTo(MProductCategory::class, 'parent_category_id');
    }

    // JobRequestモデルとのリレーション
    public function jobRequest()
    {
        return $this->hasMany(JobRequest::class, 'category_id');
    }
}
