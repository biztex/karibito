<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Chatroom;
use App\Models\PurchasedProduct;
use App\Models\Product;


class PurcahsedProductService
{

    // private $product_service;

    // public function __construct(ProductService $product_service)
    // {
    //     $this->product_service = $product_service;
    // }

    public function storePurchasedProduct(Chatroom $chatroom)
    {
        $product = $chatroom->reference;
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale', 'status'];

        $purchased_product = new PurchasedProduct;
        $purchased_product->user_id = $product->user_id;
        foreach($columns as $column){
            $purchased_product->$column = $product[$column];
        }
        $purchased_product->is_draft = Product::NOT_DRAFT;
        $purchased_product->save();
    }

    /**
     * 新規有料オプション追加
     */
    public function storePurchasedAdditionalOption(Chatroom $chatroom)
    {
        if (isset($request['option_name'])) {
            foreach ($request['option_name'] as $index => $value) {
                if (null !== ($request['option_name'][$index])) {
                    $options = [
                        'name' => $request['option_name'][$index],
                        'price' => $request['option_price'][$index],
                        'is_public' => $request['option_is_public'][$index]
                    ];
                    $product = Product::find($id);
                    $product->additionalOption()->create($options);
                }
            }
        }
    }
}