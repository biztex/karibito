<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\PurchasedProduct;
use App\Models\AdditionalOption;
use Illuminate\Http\Request;

class PurchasedProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chatroom $chatroom)
    {
        $product = PurchasedProduct::find($chatroom->referencePurchased->id);

        $additional_options = $product->purchasedAdditionalOption->where('is_public',AdditionalOption::STATUS_PUBLISH);

        return view('purchased_product.show',compact('product', 'additional_options'));}
}
