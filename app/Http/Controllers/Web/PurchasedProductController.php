<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PurchasedProduct;
use App\Models\AdditionalOption;
use Illuminate\Http\Request;

class PurchasedProductController extends Controller
{
    public function show(PurchasedProduct $product)
    {
        $additional_options = $product->additionalOption->where('is_public',AdditionalOption::STATUS_PUBLISH);

        return view('purchased_product.show',compact('product', 'additional_options'));}
}
