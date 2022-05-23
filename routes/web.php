<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Mypage\UserProfileController;
use App\Http\Controllers\Web\Mypage\MypageController;
use App\Http\Controllers\Web\Mypage\CoverController;


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

Route::get('sam',function(){
    return view('sam');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {

    // 会員登録・プロフィール登録
    Route::middleware('exsist.user.profile')->group(function () {
        Route::resource('user_profile',UserProfileController::class,['only' => ['create','store']]);
    });

    // マイページ・プロフィール編集
    Route::middleware('null.user.profile')->group(function () {
        Route::get('mypage', [MypageController::class, 'show'])->name('mypage');
        Route::resource('user_profile',UserProfileController::class,['only' => ['update']]);
        Route::put('update_cover', [CoverController ::class, 'update'])->name('cover.update');
    });
    Route::get('created_user', [UserProfileController::class, 'showComplete'])->name('complete.show');


});



// index:一覧画面(get)
// create:登録画面(get)
// store:登録(post)
// show:詳細画面(get)
// edit:編集画面(get)
// update:編集(put)
// destroy:削除(delete)

Route::get('',[HomeController::class, 'index']);

Route::get('add_category', [CategoryController::class, 'createCategory']);

Route::get('contact', [ContactController::class, 'contact']);
Route::get('draft', [ContactController::class, 'indexDraft']);

Route::get('estimate', [EstimateController::class, 'index']);

Route::get('evaluation', [EvaluationController::class, 'index']);

Route::get('faq_answer', [FaqController::class, 'indexAnswer']);
Route::get('faq_detail', [FaqController::class, 'indexDetail']);
Route::get('faq_post', [FaqController::class, 'createPost']);
Route::get('faq', [FaqController::class, 'index']);

Route::get('favorite', [MypageController::class, 'indexFavorite']);
Route::get('friends', [MypageController::class, 'indexFriends']);
Route::get('member', [MypageController::class, 'showMember']);
Route::get('past', [MypageController::class, 'indexPast']);

Route::get('news_detail',[NewsController::class,'showDetail']);
Route::get('news',[NewsController::class,'indexNews']);

Route::get('payment_history',[PaymentController::class,'index']);

Route::get('point_history',[PointController::class,'index']);

Route::get('secret01',[SecretController::class,'showSecret01']);
Route::get('secret02',[SecretController::class,'showSecret02']);
Route::get('secret03',[SecretController::class,'showSecret03']);
Route::get('secret04',[SecretController::class,'showSecret04']);
Route::get('secret05',[SecretController::class,'showSecret05']);
Route::get('secret06',[SecretController::class,'showSecret06']);

Route::get('service_detail',[ServiceController::class,'showService']);
Route::get('service',[ServiceController::class,'indexService']);

Route::get('notation',[NotationController::class,'show']);

Route::get('privacy',[PrivacyController::class,'show']);

Route::get('publication',[PublicationController::class,'index']);


// google login
Route::get('/register/google', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/register/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);


Route::get('/login/google', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);

// facebook login
Route::get('/login/facebook', [FacebookLoginController::class, 'getFacebookAuth']);
Route::get('/login/facebook/callback', [FacebookLoginController::class, 'authFacebookCallback']);
// facebookにメアドがない場合
// Route::get('/register/facebook/form', [FacebookRegisterController::class, 'form'])->middleware('exists.session.facebookid')->name('register.facebook.form');
// Route::post('register/facebook', [FacebookRegisterController::class, 'register'])->name('register.facebook.store');


Route::prefix('sample')->group(function (){
    Route::view('', 'sample.index');
    Route::view('add_category', 'sample.add_category');
    Route::view('contact', 'sample.contact');
    Route::view('draft', 'sample.draft');
    Route::view('estimate', 'sample.estimate');
    Route::view('evaluation', 'sample.evaluation');
    Route::view('faq_answer', 'sample.faq_answer');
    Route::view('faq_detail', 'sample.faq_detail');
    Route::view('faq_post', 'sample.faq_post');
    Route::view('faq', 'sample.faq');
    Route::view('favorite', 'sample.favorite');
    Route::view('friends', 'sample.friends');
    Route::view('member', 'sample.member');
    Route::view('mypage', 'sample.mypage');
    Route::view('news_detail', 'sample.news_detail');
    Route::view('news', 'sample.news');
    Route::view('notation', 'sample.notation');
    Route::view('past', 'sample.past');
    Route::view('payment_history', 'sample.payment_history');
    Route::view('payment_history', 'sample.payment_history');
    Route::view('point_history', 'sample.point_history');
    Route::view('privacy', 'sample.privacy');
    Route::view('publication', 'sample.publication');
    Route::view('secret01', 'sample.secret01');
    Route::view('secret02', 'sample.secret02');
    Route::view('secret03', 'sample.secret03');
    Route::view('secret04', 'sample.secret04');
    Route::view('secret05', 'sample.secret05');
    Route::view('secret06', 'sample.secret06');
    Route::view('service_detail', 'sample.service_detail');
    Route::view('service', 'sample.service');
    Route::view('login', 'sample.login');
});