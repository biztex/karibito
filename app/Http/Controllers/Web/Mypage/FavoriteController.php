<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user_product_favorites = Favorite::product()->get();
        $user_job_request_favorites = Favorite::jobRequest()->get();
        $products = array();
        $job_requests = array();

        foreach($user_product_favorites as $user_product_favorite) {
                $products[] = $user_product_favorite->reference;
        };
        foreach($user_job_request_favorites as $user_job_request_favorite) {
            $job_requests[] = $user_job_request_favorite->reference;
        };


        return view('mypage.favorite.index', compact('products', 'job_requests'));
    }

    // お気に入りを削除
    public function delete(Request $request)
    {
        if($request->product_id) {
            $favorite = Favorite::product()->where('reference_id', $request->product_id)->first();
        } else {
            $favorite = Favorite::jobRequest()->where('reference_id', $request->job_request_id)->first();
        }

        $favorite->delete();
        return redirect()->back()->with('flash_msg', 'お気に入りを解除しました！');
    }

    // お気に入りを登録
    public function store(Request $request)
    {
        $favorites = [
            'user_id' => \Auth::user()->id,
        ];

        if(isset($request->product_id)) {
            $product = Product::find($request->product_id);
        }else{
            $product = JobRequest::find($request->job_request_id);
        }

        $product->favorites()->create($favorites);

        // フラッシュメッセージ追加
        return redirect()->back()->with('flash_msg', 'お気に入りに追加しました！');
    }
}
