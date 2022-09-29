<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    const RESIZE_WIDTH = 720;

    protected $guarded = [ 'id' ];

    // Productモデルとのリレーション
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
