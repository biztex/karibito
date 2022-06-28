<?php

namespace App\Services;

use App\Models\AdditionalOption;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductQuestion;

class ProductService
{
    /**
     * 新規商品投稿
     */
    public function storeProduct(array $params):Product
    {
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale'];

        $product = new Product;
        $product->user_id = \Auth::id();
        foreach($columns as $column){
            $product->$column = $params[$column];
        }
        $product->is_draft = Product::NOT_DRAFT;
        $product->status = Product::STATUS_PUBLISH;
        $product->save();

        return $product;
    }

    /**
     * 新規有料オプション追加
     */
    public function storeAdditionalOption(array $request, $id)
    {
        for ($i = 0; $i < 3; $i++) {
            if (isset($request['option_name'][$i])) {
                $additional_option = new AdditionalOption;
                $additional_option->create([
                    'name' => $request['option_name'][$i],
                    'price' => $request['option_price'][$i],
                    'is_public' => $request['option_is_public'][$i],
                    'product_id' => $id
                ]);
            }
        }
    }

    /**
     * 新規よくある質問追加
     */
    public function storeProductQuestion(array $request, $id)
    {
        for ($i = 0; $i < 3; $i++) {
            if (isset($request['question_title'][$i])) {
                $question = new ProductQuestion;
                $question->create([
                    'title' => $request['question_title'][$i],
                    'answer' => $request['answer'][$i],
                    'product_id' => $id
                ]);
            }
        }
    }


    /**
     * 商品編集
     */
    public function updateProduct(array $params, $product):Product
    {
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale'];

        foreach($columns as $column){
            $product->$column = $params[$column];
        }
        $product->is_draft = Product::NOT_DRAFT;
        $product->status = Product::STATUS_PUBLISH;
        $product->save();
        return $product;
    }


    /**
     * 有料オプション編集
     */
    public function updateAdditionalOption(array $request, $product)
    {
        $product->additionalOptions()->delete();

        if (isset($request['option_name'])) {
            foreach ($request['option_name'] as $index => $option) {
                $product->additionalOptions()->create([
                    'name' => $request['option_name'][$index],
                    'price' => $request['option_price'][$index],
                    'is_public' => $request['option_is_public'][$index]
                ]);
            }
        }
    }


    /**
     * よくある質問編集
     */
    public function updateProductQuestion(array $request, $product)
    {
        $product->productQuestions()->delete();

        if (isset($request['question_title'])) {
            foreach ($request['question_title'] as $index => $title){
                $product->productQuestions()->create([
                    'title' => $request['question_title'][$index],
                    'answer' => $request['answer'][$index]
                ]);
            }
        }
    }


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


    /**
     * 新規リクエスト下書き保存
     */
    public function storeDraftProduct(array $params):Product
    {
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale'];

        $product = new Product;
        $product->user_id = \Auth::id();
        foreach($columns as $column){
            $product->$column = $params[$column];
        }
        $product->is_draft = Product::IS_DRAFT;
        $product->status = Product::STATUS_PRIVATE;
        $product->save();

        return $product;
    }


    /**
     * 新規有料オプション下書き保存
     */
    public function storeDraftAdditionalOption(array $request, $id)
    {
        for ($i = 0; $i < 3; $i++) {
            if (isset($request['option_name'][$i])) {
                $additional_option = new AdditionalOption;
                $additional_option->create([
                    'name' => $request['option_name'][$i],
                    'price' => $request['option_price'][$i],
                    'is_public' => $request['option_is_public'][$i],
                    'product_id' => $id
                ]);
            }
        }
    }


    /**
     * 新規よくある質問下書き保存
     */
    public function storeDraftProductQuestion(array $request, $id)
    {
        for ($i = 0; $i < 3; $i++) {
            if (isset($request['question_title'][$i])) {
                $question = new ProductQuestion;
                $question->create([
                    'title' => $request['question_title'][$i],
                    'answer' => $request['answer'][$i],
                    'product_id' => $id
                ]);
            }
        }
    }


}
