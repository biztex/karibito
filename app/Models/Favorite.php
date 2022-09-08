<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reference()
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
    }

    /**
     * ログインユーザーである
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoginUser($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    /**
     * referenceがProduct かつ
     * ログインユーザーとuser_idが一致しているもの
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProduct($query)
    {
        return $query->loginUser()->where('reference_type', 'App\Models\Product');
    }

    /**
     * referenceがJobRequest かつ
     * ログインユーザーとuser_idが一致しているもの
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJobRequest($query)
    {
        return $query->loginUser()->where('reference_type', 'App\Models\JobRequest');
    }

}


