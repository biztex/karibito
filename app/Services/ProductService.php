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

    /**
     * 提供画像編集（画像変更）
     * 編集：登録されているものを一度削除して入れなおす
     */
    public function updateImage($request, $id)
    {
        // 登録済の画像を配列で取得
        $old_images = ProductImage::where('product_id',$id)->get();
        $a = $request->image_status;
        $b = json_decode($a,true);

        $requests = $request->file('path');
        // 画像リクエストがあれば実行
        if (isset($b)) {
            for($i=0; $i<10; $i++){
                if(isset($b[$i]) && $b[$i] == "delete"){
                    // 削除されたら何もしない
                }elseif(isset($b[$i]) && $b[$i] == "insert"){
                    // 挿入されたらリクエストを挿入
                    $new_images[] = $request->path[$i];
                }elseif(isset($old_images[$i])){
                    // 変更なければ元のpathを登録しなおす
                    $new_images[] = $old_images[$i];
                }
            }

            // DBに新しくすべて登録
            foreach ($new_images as $val) {
                $product_image = new ProductImage;
                $product_image->path = $val->store('product_paths', 'public');
                $product_image->product_id = $id;
                $product_image->save();
            }

            // 登録済のものをすべて削除
            if (isset($old_images)){
                foreach($old_images as $val){
                    $val->delete();
                    \Storage::delete('public/'.$val);
                }
            }

            return $product_image;

        }
    }
}
