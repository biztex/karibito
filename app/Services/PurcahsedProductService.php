<?php

namespace App\Services;

use App\Models\Chatroom;
use App\Models\PurchasedProduct;
use App\Models\Product;


class PurcahsedProductService
{

    public function storePurchasedProduct(Chatroom $chatroom)
    {
        // 一つにまとめても良いか？商品の中でリクエストと分岐して、商品の場合はこの中で他のを呼ぶ

        $product = $chatroom->reference;
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale', 'status'];

        $purchased_product = new PurchasedProduct;
        $purchased_product->user_id = $product->user_id;
        foreach($columns as $column){
            $purchased_product->$column = $product[$column];
        }
        $purchased_product->is_draft = Product::NOT_DRAFT;
        $purchased_product->save();
        $chatroom->purchased_reference_id = $purchased_product->id;
        $chatroom->purchased_reference_type = 'App\Models\PurchasedProduct';

        $chatroom->save();

        return $purchased_product->id;
    }

    /**
     * 新規有料オプション追加
     */
    public function storePurchasedAdditionalOption(Chatroom $chatroom, $purchased_product_id)
    {
        $product = $chatroom->reference;
        $product_options = $product->additionalOption;
        if (isset($product_options)) {
            foreach ($product_options as $product_option) {
                $options = [
                    'name' => $product_option->name,
                    'price' => $product_option->price,
                    'is_public' => $product_option->is_public,
                ];
                $purchased_product = PurchasedProduct::find($purchased_product_id);
                $purchased_product->purchasedAdditionalOption()->create($options);
            }
        }
    }

    /**
     * 新規よくある質問追加
     */
    public function storePurchasedProductQuestion(Chatroom $chatroom, $purchased_product_id)
    {
        $product = $chatroom->reference;
        $product_questions = $product->productQuestion;

        if (isset($product_questions)) {
            foreach ($product_questions as $product_question) {
                $questions = [
                    'title' => $product_question->title,
                    'answer' => $product_question->answer,
                ];

                $purchased_product = PurchasedProduct::find($purchased_product_id);
                $purchased_product->purchasedProductQuestion()->create($questions);
            }
        }
    }

    /**
     * 新規動画追加
     */
    public function storePurchasedProductLink(Chatroom $chatroom, $purchased_product_id)
    {
        $product = $chatroom->reference;
        $product_links = $product->productLink;

        if (isset($product_links)) {
            foreach ($product_links as $product_link) {
                $links = [
                    'youtube_link' => $product_link->youtube_link,
                ];
                $purchased_product = PurchasedProduct::find($purchased_product_id);
                $purchased_product->purchasedProductLink()->create($links);
            }
        }
    }

    /**
     * 提供画像登録
     */
    public function storePurchasedProductImage(Chatroom $chatroom, $purchased_product_id)
    {
        $product = $chatroom->reference;
        $product_images = $product->productImage;

        if (isset($product_images)) {
            foreach ($product_images as $product_image) {
                $product_image = [
                    'path' => $product_image->path,
                ];
                $purchased_product = PurchasedProduct::find($purchased_product_id);
                $purchased_product->purchasedProductImage()->create($product_image);
            }
        }
    }
}