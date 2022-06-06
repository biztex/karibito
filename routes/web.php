<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Mypage\UserProfileController;
use App\Http\Controllers\Web\Mypage\MypageController;
use App\Http\Controllers\Web\Mypage\CoverController;
use App\Http\Controllers\Web\Mypage\IconController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\SecretController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NotationController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\PublicationController;


use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\Auth\FacebookRegisterController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('sample',function(){
    return view('sample');
});



// 画面組込中
Route::view('/post'  , 'post.post')->name('post');
Route::view('service_preview','post.service_preview')->name('service_preview');
Route::view('service_provide','post.service_provide')->name('service_provide');
Route::view('service_detail','post.service_detail')->name('service_detail');
Route::view('service_request','post.service_request')->name('service_request');
Route::view('service_thanks','post.service_thanks')->name('service_thanks');
Route::view('service','post.service')->name('service');
Route::view('draft','post.draft')->name('draft');
Route::view('publication','post.publication')->name('publication');
Route::view('request','post.request_list')->name('request');
Route::view('request_detail','post.request_detail')->name('request_detail');


Route::view('secret01','secret.secret01')->name('secret01');
Route::view('secret02','secret.secret02')->name('secret02');
Route::view('secret03','secret.secret03')->name('secret03');
Route::view('secret04','secret.secret04')->name('secret04');
Route::view('secret05','secret.secret05')->name('secret05');
Route::view('secret06','secret.secret06')->name('secret06');


Route::view('support','support.support')->name('support');
Route::view('support_detail','support.support_detail')->name('support_detail');
Route::view('guide','support.guide')->name('guide');

Route::view('member','user.member')->name('member');
Route::view('member_config','user.member_config')->name('member_config');
Route::view('member_config_pass','user.member_config_pass')->name('member_config_pass');
Route::view('member_config_email','user.member_config_email')->name('member_config_email');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {

    // 会員登録・プロフィール登録
    Route::middleware('exist.user.profile')->group(function () {
        Route::resource('user_profile',UserProfileController::class,['only' => ['index','create','store']]);
    });

    // マイページ・プロフィール編集
    Route::middleware('null.user.profile')->group(function () {
        Route::get('mypage', [MypageController::class, 'show'])->name('mypage');
        Route::put('user_profile',[UserProfileController::class,'update'])->name('user_profile.update');
        Route::put('update_cover', [CoverController ::class, 'update'])->name('cover.update');
        Route::get('delete_cover', [CoverController ::class, 'delete'])->name('cover.delete');
        Route::get('delete_icon', [IconController ::class, 'delete'])->name('icon.delete');
        Route::get('created_user', [UserProfileController::class, 'showComplete'])->name('complete.show');
    });


});

// プライバシーポリシーと運営会社
Route::view('/privacy-policy'  , 'privacy-policy')->name('privacy-policy');
Route::view('/company', 'company')->name('company');
Route::view('/terms-of-service','terms-of-service')->name('terms-of-service');


// index:一覧画面(get)
// create:登録画面(get)
// store:登録(post)
// show:詳細画面(get)
// edit:編集画面(get)
// update:編集(put)
// destroy:削除(delete)

Route::get('',[HomeController::class, 'index'])->name('home');

Route::get('add_category', [CategoryController::class, 'createCategory']);

Route::get('contact', [ContactController::class, 'contact']);

Route::get('estimate', [EstimateController::class, 'index']);

Route::get('evaluation', [EvaluationController::class, 'index']);

Route::get('faq_answer', [FaqController::class, 'indexAnswer']);
Route::get('faq_detail', [FaqController::class, 'indexDetail']);
Route::get('faq_post', [FaqController::class, 'createPost']);
Route::get('faq', [FaqController::class, 'index']);

Route::get('favorite', [MypageController::class, 'indexFavorite']);
Route::get('friends', [MypageController::class, 'indexFriends']);
Route::get('past', [MypageController::class, 'indexPast']);

Route::get('news_detail',[NewsController::class,'showDetail']);
Route::get('news',[NewsController::class,'indexNews']);

Route::get('payment_history',[PaymentController::class,'index']);

Route::get('point_history',[PointController::class,'index']);

Route::get('notation',[NotationController::class,'show']);






// google login
Route::get('/register/google', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);

// facebook login
Route::get('/register/facebook', [FacebookLoginController::class, 'getFacebookAuth']);
Route::get('/login/facebook', [FacebookLoginController::class, 'getFacebookAuth']);
Route::get('/login/facebook/callback', [FacebookLoginController::class, 'authFacebookCallback']);


Route::prefix('sample')->group(function (){
    Route::view('add_category', 'sample.add_category');
    Route::view('contact', 'sample.contact');
    Route::view('estimate', 'sample.estimate');
    Route::view('evaluation', 'sample.evaluation');
    Route::view('faq_answer', 'sample.faq_answer');
    Route::view('faq_detail', 'sample.faq_detail');
    Route::view('faq_post', 'sample.faq_post');
    Route::view('faq', 'sample.faq');
    Route::view('favorite', 'sample.favorite');
    Route::view('friends', 'sample.friends');
    Route::view('news_detail', 'sample.news_detail');
    Route::view('news', 'sample.news');
    Route::view('notation', 'sample.notation');
    Route::view('past', 'sample.past');
    Route::view('payment_history', 'sample.payment_history');
    Route::view('payment_history', 'sample.payment_history');
    Route::view('point_history', 'sample.point_history');
});