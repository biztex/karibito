<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Services\UserNotificationService;


class FavoriteController extends Controller
{

    private $user_notification_service;

    public function __construct(UserNotificationService $user_notification_service)
    {
        $this->user_notification_service = $user_notification_service;
    }

    public function index()
    {
        $products = Favorite::product()->paginate(10);
        $job_requests = Favorite::jobRequest()->paginate(10);
        $today = new Carbon('today');

        return view('mypage.favorite.index', compact('products', 'job_requests', 'today'));
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
        $favorite_user = [
            'user_id' => \Auth::user()->id,
        ];

        if(isset($request->product_id)) {
            $product = Product::find($request->product_id);
        }else{
            $product = JobRequest::find($request->job_request_id);
        }

        $product->favorites()->create($favorite_user);
        $this->user_notification_service->storeUserNotificationLike($product);

        // フラッシュメッセージ追加
        return redirect()->back()->with('flash_msg', 'お気に入りに追加しました！');
    }
}
