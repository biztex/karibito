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
        $paths = $request->file('paths');

        if ($paths !== null) {
            foreach ($paths as $path) {
                    $product_image = new ProductImage();
                    $product_image->path = $path->store('product_paths', 'public');
                    $product_image->product_id = $id;
                    $product_image->save();
            }
        }
    }

    /**
     * 提供画像編集（画像変更）
     * 編集：登録されているものを一度削除して入れなおす
     */
    public function updateImage($request, $id)
    {
        // 登録済の画像を配列で取得
        $old_images = ProductImage::where('product_id',$id)->get();
        $image_status = json_decode($request->image_status,true);

        // 追加・変更・削除があれば実行
        if (isset($image_status)) {
            for($i=0; $i<10; $i++){
                if(isset($image_status[$i]) && $image_status[$i] === "delete"){
                    // 削除されたら何もしない

                }elseif(isset($image_status[$i]) && $image_status[$i] === "insert"){
                    // 挿入されたらリクエストをDBに登録
                    $product_image = new ProductImage();
                    $product_image->path = $request->paths[$i]->store('product_paths', 'public');
                    $product_image->product_id = $id;
                    $product_image->save();

                }elseif(isset($old_images[$i])){
                    // 変更なければ元のpathをDBに登録しなおす
                    $new_images[] = $old_images[$i];
                    $product_image = new ProductImage();
                    $product_image->path = $old_images[$i]->path;
                    $product_image->product_id = $id;
                    $product_image->save();
                }
            }

            // 登録済のものをDBからすべて削除
            foreach($old_images as $val){
                $val->delete();
            }
        }
    }
}
