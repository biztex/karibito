<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Web\Mypage\ChangePasswordController;
use App\Http\Controllers\Web\Mypage\ChangeTelController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Mypage\UserProfileController;
use App\Http\Controllers\Web\Mypage\MypageController;
use App\Http\Controllers\Web\Mypage\CoverController;
use App\Http\Controllers\Web\Mypage\IconController;
use App\Http\Controllers\Web\Mypage\WithdrawController;
use App\Http\Controllers\Web\Mypage\ProductController as MypageProductController;
use App\Http\Controllers\Web\Mypage\JobRequestController as MypageJobRequestController;
use App\Http\Controllers\Web\Mypage\IdentificationController;
use App\Http\Controllers\Web\Mypage\ChangeEmailController;

use App\Http\Controllers\Web\OtherUser\UserController as OtherUserController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\ChatroomController;
use App\Http\Controllers\Web\ProductChatroomController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Web\ContactController;


// 管理者用

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

Route::get('sample', function () {
    return view('sample');
});

// 画面組込中
Route::view('service_preview', 'post.service_preview')->name('service_preview');
Route::view('service_provide', 'post.service_provide')->name('service_provide');
Route::view('service_detail', 'post.service_detail')->name('service_detail');
Route::view('service_request', 'post.service_request')->name('service_request');
Route::view('service_thanks', 'post.service_thanks')->name('service_thanks');
Route::view('service', 'post.service')->name('service');
Route::view('request', 'post.request_list')->name('request');
Route::view('request_detail', 'post.request_detail')->name('request_detail');

Route::view('support', 'support.support')->name('support');
Route::view('support_detail', 'support.support_detail')->name('support_detail');
Route::view('guide', 'support.guide')->name('guide');

Route::get('resume',[ResumeController::class, 'resume'])->middleware('can:identify')->name('resume');
Route::view('resume_edit','resume_edit')->name('resume_edit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    // 会員登録・プロフィール登録
    Route::middleware('exist.user.profile')->group(function () {
        Route::resource('user_profile', UserProfileController::class, ['only' => ['index', 'create', 'store']]);
    });

    // マイページ・プロフィール編集
    Route::middleware('null.user.profile')->group(function () {
        Route::get('mypage', [MypageController::class, 'show'])->name('mypage');
        Route::put('user_profile', [UserProfileController::class, 'update'])->name('user_profile.update');
        Route::put('update_cover', [CoverController::class, 'update'])->name('cover.update');
        Route::get('delete_cover', [CoverController::class, 'delete'])->name('cover.delete');
        Route::get('delete_icon', [IconController::class, 'delete'])->name('icon.delete');
        Route::get('created_user', [UserProfileController::class, 'showComplete'])->name('complete.show');
        Route::get('identification',[IdentificationController::class, 'index']);
        Route::post('identification',[IdentificationController::class, 'update'])->name('identification');
        // メンバー情報
        Route::view('member', 'member.index')->name('member');
        // 会員情報
        Route::prefix('member_config')->name('member_config.')->group(function () {
            Route::view('', 'member.member_config.index')->name('index');
            // メールアドレス変更
            Route::controller(ChangeEmailController::class)->name('email.')->group(function () {
                Route::get('email', 'edit')->name('edit');
                Route::post('email', 'sendChangeEmailLink')->name('send');
            });
            // パスワード変更
            Route::middleware('can:exist.password')->controller(ChangePasswordController::class)->name('password.')->group(function () {
                Route::get('password', 'edit')->name('edit');
                Route::post('password', 'update')->name('update');
            });
            // 電話番号変更
            Route::controller(ChangeTelController::class)->name('tel.')->group(function () {
                Route::get('tel', 'edit')->name('edit');
                Route::post('tel', 'update')->name('update');
            });
        });
    });

    // メールアドレス変更確認（Authの後に書かないとダメ）
    Route::get('email/{token}', [ChangeEmailController::class, 'updateEmail'])->name('email.update');

    // 退会フォーム表示
    Route::get('withdraw', [WithdrawController::class, 'showWithdrawForm'])->name('showWithdrawForm');
    Route::post('withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw');

    // 提供・リクエスト一覧
    Route::get('job_request',function () { return redirect()->route('publication');});
    Route::get('publication',[MypageJobRequestController::class, 'index'])->name('publication');
    // 提供・リクエスト 下書き一覧
    Route::get('draft',[MypageJobRequestController::class, 'draft'])->name('draft');

    // 商品登録
    Route::prefix('product')->controller(MypageProductController::class)->name('product.')->group(function () {
        Route::middleware(['can:my.product,product', 'can:identify'])->group(function () {
            Route::get('{product}/edit', 'edit')->name('edit');
            Route::post('{product}/update', 'update')->name('update');
            Route::post('post/{product}/edit', 'postEdit')->name('post.edit');
            Route::delete('{product}','destroy')->name('destroy');
            Route::post('edit/{product}/preview','editPreview')->name('edit.preview');
            Route::post('{product}/preview','updatePreview')->name('update.preview');
            Route::post('{product}/draft','updateDraft')->name('update.draft');
        });
        Route::middleware('can:identify')->group(function () {
            Route::get('create', 'create')->name('create');
            Route::post('post/create', 'postCreate')->name('post.create');
            Route::post('store', 'store')->name('store');
            Route::post('draft', 'storeDraft')->name('store.draft');
            Route::post('preview', 'preview')->name('preview');
            Route::post('post/store/preview', 'storePreview')->name('store.preview');
            Route::get('/', 'index')->name('index');
        });
        Route::get('{product}', 'show')->name('show');
    });

    // リクエスト
    Route::prefix('job_request')->controller(MypageJobRequestController::class)->name('job_request.')->group(function () {
        Route::middleware(['can:my.job.request,job_request', 'can:identify'])->group(function () {
            Route::get('{job_request}/edit','edit')->name('edit');
            Route::post('{job_request}/update','update')->name('update');
            Route::post('post/{job_request}/edit', 'postEdit')->name('post.edit');
            Route::delete('{job_request}','destroy')->name('destroy');
            Route::post('edit/{job_request}/preview','editPreview')->name('edit.preview');
            Route::post('{job_request}/preview','updatePreview')->name('update.preview');
            Route::post('{job_request}/draft','updateDraft')->name('update.draft');
        });
        Route::middleware('can:identify')->group(function () {
            Route::get('create','create')->name('create');
            Route::post('post/create', 'postCreate')->name('post.create');
            Route::post('store','store')->name('store');
            Route::post('draft','storeDraft')->name('store.draft');
            Route::post('preview','preview')->name('preview');
            Route::post('post/store/preview','storePreview')->name('store.preview');
        });
        Route::get('{job_request}','show')->name('show');
    });

    // 秘訣
    Route::view('secret01','secret.secret01')->name('secret01');
    Route::view('secret02','secret.secret02')->name('secret02');
    Route::view('secret03','secret.secret03')->name('secret03');
    Route::view('secret04','secret.secret04')->name('secret04');
    Route::view('secret05','secret.secret05')->name('secret05');
    Route::view('secret06','secret.secret06')->name('secret06');

});

// プライバシーポリシーと運営会社
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::view('/company', 'company')->name('company');
Route::view('/terms-of-service', 'terms-of-service')->name('terms-of-service');

// GET	        /photo      	        photo.index　          一覧画面
// GET	        /photo/create	        photo.create　         登録画面
// POST	        /photo      	        photo.store　          登録処理
// GET	        /photo/{photo}	        photo.show　           詳細画面
// GET	        /photo/{photo}/edit	    photo.edit　           編集画面
// PUT/PATCH	/photo/{photo}	        photo.update　         編集処理
// DELETE	    /photo/{photo}	        photo.destroy　        削除処理

// google login
Route::get('/register/google', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);

// facebook login
Route::get('/register/facebook', [FacebookLoginController::class, 'getFacebookAuth']);
Route::get('/login/facebook', [FacebookLoginController::class, 'getFacebookAuth']);
Route::get('/login/facebook/callback', [FacebookLoginController::class, 'authFacebookCallback']);

// お問い合わせ
Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('contact', [ContactController::class, 'sendSupportMail']);

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('index/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('news', [NewsController::class, 'index'])->name('news.index');

// --管理者画面-----------------------------------------------------------------------------
Route::prefix('admin')->name('admin.')->group(function () {

    require __DIR__ . '/admin.php';

    Route::middleware('auth:admin')->group(function () {

        // --最高管理者のみ-----------------------------------------------------------------
        Route::middleware('admin.role')->group(function () {
            Route::resource('/', AdminController::class,['only' => ['index']]);
        });

        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
        Route::resource('/users',UserController::class,['only' => ['index', 'show']]);
        Route::post('/users/{id}/is_identify',[UserController::class, 'approve'])->name('approve');
        Route::post('/users/{id}/not_identify',[UserController::class, 'revokeApproval'])->name('revokeApproval');

        //お知らせ機能
        Route::resource('/news', AdminNewsController::class);
    });

});

// 未着手
Route::prefix('sample')->group(function () {
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
    Route::view('point_history', 'sample.point_history');
});

// 該当ユーザーの各ページ
Route::prefix('user')->name('user.')->group(function () {
    Route::get('{user}/publication',[OtherUserController::class, 'publication'])->name('publication');
    Route::get('{user}/mypage',[OtherUserController::class, 'mypage'])->name('mypage');

});

Route::get('chatroom', [ChatroomController::class, 'index'])->name('chatroom.index');

// やり取り画面組込中
Route::prefix('chatroom/product')->controller(ProductChatroomController::class)->name('chatroom.product.')->group(function () {
    Route::get('start/{product}', 'newroom')->name('newroom');
    Route::post('start/{product}', 'start')->name('start');
    Route::get('{product_chatroom}', 'show')->name('show');
    Route::post('message/{product_chatroom}', 'message')->name('message');
    Route::post('{product_chatroom}/proposal','proposal')->name('proposal');
    Route::post('{product_proposal}/purchese','purchess')->name('purchese');

    Route::get('{product}/sample', 'sample')->name('sample');

    // 支払い
    Route::get('purchese/{product_proposal}','purchese')->name('purchese');
    Route::get('purchese/{product_proposal}/confirm','purchese_confirm')->name('purchese_confirm');
    Route::post('purchesed/{product_proposal}','purchesed')->name('purchesed');
    // 評価
    Route::view('cart/buy08','chatroom.cart_buy08');
    Route::view('cart/buy09','chatroom.cart_buy09');

});

// DM画面組込まで
Route::view('/dm','mypage.dm.index')->name('dm.index');
Route::view('/dm/show','mypage.dm.show');
