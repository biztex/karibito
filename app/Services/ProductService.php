<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Requests\UserProfile\StoreRequest;

class ProductService
{

    /**
     * 提供画像登登録
     */
    public function storeImage($request, $id)
    {
        $paths = $request->file('path');
        if (isset($paths)) {
            foreach ($paths as $path) {
                $product_image = new ProductImage;
                $product_image->path = $path->store('product_paths', 'public');
                $product_image->product_id = $id;
                $product_image->save();
            }
            return $product_image;
        }
    }
}
