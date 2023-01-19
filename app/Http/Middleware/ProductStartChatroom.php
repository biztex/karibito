<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Chatroom;

class ProductStartChatroom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $number_of_sold = Chatroom::numberOfSold($request->product->id);

        if($request->product->user_id === \Auth::id()) {
            return redirect()->route('product.show', $request->product->id);
        }elseif($request->product->number_of_sale === Product::ONE_OF_SALE && $number_of_sold !== 0){
            return redirect()->route('product.show', $request->product->id)->with('flash_msg','このサービスは売り切れています。ユーザーにDMでお問い合わせください。');
        }
        return $next($request);
    }
}
