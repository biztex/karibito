<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\JobRequestController;
use App\Http\Controllers\Admin\MCommissionRateController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\KaribitoSurveyController as AdminKaribitoSurveyController;
use App\Http\Controllers\Admin\MProductCategoryController;
use App\Http\Controllers\Admin\MProductChildCategoryController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\TransferRequestController as AdminTransferRequestController;
use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Web\Mypage\ChangePasswordController;
use App\Http\Controllers\Web\Mypage\ChangeTelController;
use App\Http\Controllers\Web\Mypage\PaymentController;
use App\Http\Controllers\Web\Mypage\StripeController;
use App\Http\Controllers\Web\Mypage\BankAccountController;
use App\Http\Controllers\Web\Mypage\ProfitController;
use App\Http\Controllers\Web\Mypage\TransferRequestController;
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
use App\Http\Controllers\Web\Mypage\ResumeController;
use App\Http\Controllers\Web\Mypage\SkillController;
use App\Http\Controllers\Web\Mypage\CareerController;
use App\Http\Controllers\Web\Mypage\JobController;
use App\Http\Controllers\Web\Mypage\EvaluationController;
use App\Http\Controllers\Web\Mypage\CouponController;
use App\Http\Controllers\Web\Mypage\PointController;

use App\Http\Controllers\Web\OtherUser\UserController as OtherUserController;
use App\Http\Controllers\Web\OtherUser\ProductController as OtherUserProductController;
use App\Http\Controllers\Web\OtherUser\JobRequestController as OtherUserJobRequestController;
use App\Http\Controllers\Web\OtherUser\BlogController as OtherUserBlogController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\ChatroomController;
use App\Http\Controllers\Web\CancelController;
use App\Http\Controllers\Web\DmroomController;
use App\Http\Controllers\Web\KaribitoSurveyController;
use App\Http\Controllers\Web\FollowController;
use App\Http\Controllers\Web\AlreadyReadController;
use App\Http\Controllers\Web\PurchasedProductController;
use App\Http\Controllers\Web\PurchasedJobRequestController;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Mypage\UserNotificationSettingController;
use App\Http\Controllers\Web\Mypage\UserNotificationController;

use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\Mypage\BlogController;
use App\Http\Controllers\Web\Mypage\BlogImageController;
use App\Http\Controllers\Web\Mypage\FavoriteController;
use App\Http\Controllers\Web\Mypage\PortfolioController;

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
Route::fallback(function() {
    return response()->view('errors.404', [], 404);
});
Route::middleware('update_latest_login_datetime')->group(function () {

    // 画面組込中
    Route::view('service', 'post.service')->name('service');
    Route::view('request', 'post.request_list')->name('request');
    Route::view('request_detail', 'post.request_detail')->name('request_detail');

    Route::view('support', 'support.support')->name('support');
    Route::view('support_detail', 'support.support_detail')->name('support_detail');
    Route::view('guide', 'support.guide')->name('guide');
    Route::view('karibitoguide', 'karibitoguide.support')->name('karibitoguide');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    require __DIR__ . '/auth.php';

    Route::middleware(['auth', 'verified'])->group(function () {

        // 会員登録・プロフィール登録
        Route::middleware('exist.user.profile')->group(function () {
            Route::resource('user_profile', UserProfileController::class, ['only' => ['index', 'create', 'store']]);
            Route::get('user_profile/friend_code',[UserProfileController::class, 'friend_code'])->name('friend_code');
        });

        // サブメールのルート
        Route::get('sub_email/create', [ChangeEmailController::class, 'subMailCreate'])->name('sub_mail_create');
        Route::post('sub_email/create', [ChangeEmailController::class, 'subMailStore'])->name('sub_mail_store');
        Route::post('sub_email/edit', [ChangeEmailController::class, 'subMailDestroy'])->name('sub_mail_destroy');

        // マイページ・プロフィール編集
        Route::middleware('null.user.profile')->group(function () {
            Route::get('mypage', [MypageController::class, 'show'])->name('mypage');
            Route::put('user_profile', [UserProfileController::class, 'update'])->name('user_profile.update');
            Route::put('update_cover', [CoverController::class, 'update'])->name('cover.update');
            Route::get('delete_cover', [CoverController::class, 'delete'])->name('cover.delete');
            Route::get('delete_icon', [IconController::class, 'delete'])->name('icon.delete');
            Route::get('created_user', [UserProfileController::class, 'showComplete'])->name('complete.show');
            Route::get('identification',[IdentificationController::class, 'index']);
            Route::post('identification',[IdentificationController::class, 'upload'])->name('identification');
            Route::post('can_call',[UserProfileController::class, 'updateCanCall'])->name('can_call.update');

            // スキル・経歴・職務
            // Route::middleware('can:identify')->group(function () {
                Route::get('resume',[ResumeController::class, 'show'])->name('resume.show');

                // スキル
                Route::get('skill',[SkillController::class, 'show'])->name('skill.show');
                Route::post('skill',[SkillController::class, 'store'])->name('skill.store');
                Route::post('skill/{user_skill}',[SkillController::class, 'destroy'])->middleware('can:my.skill,user_skill')->name('skill.destroy');
                Route::get('skill/{user_skill}', function () {return redirect()->route('resume.show');});

                // 経歴
                Route::get('career',[CareerController::class, 'create'])->name('career.create');
                Route::post('career',[CareerController::class, 'store'])->name('career.store');
                Route::post('career/{user_career}',[CareerController::class, 'destroy'])->middleware('can:my.career,user_career')->name('career.destroy');
                Route::get('career/{user_career}', function () {return redirect()->route('resume.show');});

                // 職務
                Route::get('job',[JobController::class, 'create'])->name('job.create');
                Route::post('job',[JobController::class, 'store'])->name('job.store');

                // ポートフォリオ
                Route::resource('portfolio', PortfolioController::class);

                // ブログ
                Route::resource('blog', BlogController::class);
                Route::post('blog_image', [BlogImageController::class, 'store'])->name('blog_image.store');
                // Route::get('blog', [FavoriteController::class, 'index'])->name('favorite.index');


                // お気に入り
                Route::get('favorite', [FavoriteController::class, 'index'])->name('favorite.index');
                Route::post('favorite', [FavoriteController::class, 'store'])->name('favorite.store');
                Route::delete('favorite', [FavoriteController::class, 'delete'])->name('favorite.delete');
            // });

            // お知らせ一覧表示(UserNotification)
            Route::get('user_notification', [UserNotificationController::class, 'index'])->name('user_notification.index');
            // お知らせ一覧表示(UserNotification)
            Route::middleware(['can:my.user.notification,user_notification'])->group(function () {
                Route::get('user_notification/{user_notification}', [AlreadyReadController::class, 'show'])->name('already_read.show');
            });

            // 評価一覧
            Route::get('evaluation',[EvaluationController::class, 'show'])->name('evaluation');

            // クーポン
            Route::get('coupon', [CouponController::class, 'index'])->name('coupon.index');
            // ポイント履歴
            Route::get('point', [PointController::class, 'index'])->name('point.index');
            // 決済履歴
            Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
            // 仮売上金
            Route::get('profit', [ProfitController::class, 'index'])->name('profit.index');
            Route::post('profit', [TransferRequestController::class, 'store'])->name('transfer_request.store');
            Route::get('transfer_request/{transfer_request}', [TransferRequestController::class, 'show'])->middleware('can:my.transfer_request,transfer_request')->name('transfer_request.show');
            // メンバー情報
            Route::view('member', 'member.index')->name('member'); //このページなくなる
            // 会員情報
            Route::prefix('setting')->name('setting.')->group(function () {
                Route::view('', 'setting.index')->name('index');
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

                // クレジットカード
                Route::controller(StripeController::class)->name('card.')->group(function () {
                    Route::get('card', 'create')->name('create');
                    Route::post('card', 'store')->name('store');
                    Route::delete('card/{card_id}', 'destroy')->name('destroy');
                    Route::get('card/{id}', function () {return redirect()->route('setting.card.create');});
                });

                // 振込口座
                Route::controller(BankAccountController::class)->name('bank.')->group(function () {
                    Route::get('bank', 'edit')->name('edit');
                    Route::post('bank', 'update')->name('update');
                    // Route::delete('bank', 'destroy')->name('destroy');
                });

                // お知らせ機能の設定
                Route::put('/notification', [UserNotificationSettingController::class, 'update'])->name('notification.update');
            });
        });

        // メールアドレス変更確認（Authの後に書かないとダメ）
        Route::get('email/{token}', [ChangeEmailController::class, 'updateEmail'])->name('email.update');

        // 退会フォーム表示
        Route::get('withdraw', [WithdrawController::class, 'showWithdrawForm'])->name('showWithdrawForm');
        Route::post('withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw');

        // 投稿ページ
        Route::get('post', [MypageProductController::class, 'post'])->name('post');

        // 提供・リクエスト一覧
        Route::get('job_request',function () { return redirect()->route('publication');});
        Route::get('product',function () { return redirect()->route('publication');});
        Route::get('publication',[MypageJobRequestController::class, 'index'])->name('publication');

        // 提供・リクエスト 下書き一覧
        Route::get('draft',[MypageJobRequestController::class, 'draft'])->name('draft');

        // 商品登録
        Route::prefix('product')->controller(MypageProductController::class)->name('product.')->group(function () {
            // Route::get('/index/{category}', 'showCategory')->name('show.category');
            Route::middleware(['can:my.product,product'/* , 'can:identify' */])->group(function () {
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::post('{product}/update', 'update')->name('update');
                Route::post('post/{product}/edit', 'postEdit')->name('post.edit')->middleware('is_ban');
                Route::delete('{product}','destroy')->name('destroy');
                Route::post('edit/{product}/preview','editPreview')->name('edit.preview');
                Route::post('{product}/preview','updatePreview')->name('update.preview');
                Route::post('{product}/draft','updateDraft')->name('update.draft');
            });
            // Route::middleware('can:identify')->group(function () {
                Route::get('create', 'create')->name('create')->middleware('is_ban');
                Route::post('post/create', 'postCreate')->name('post.create');
                Route::post('store', 'store')->name('store');
                Route::post('draft', 'storeDraft')->name('store.draft');
                Route::post('preview', 'preview')->name('preview');
                Route::post('post/store/preview', 'storePreview')->name('store.preview');
                Route::view('thanks', 'product.thanks')->name('thanks');
            // });
        });

        // リクエスト
        Route::prefix('job_request')->controller(MypageJobRequestController::class)->name('job_request.')->group(function () {
            Route::middleware(['can:my.job.request,job_request'/* , 'can:identify' */])->group(function () {
                Route::get('{job_request}/edit','edit')->name('edit')->middleware('is_ban');
                Route::post('{job_request}/update','update')->name('update');
                Route::post('post/{job_request}/edit', 'postEdit')->name('post.edit');
                Route::delete('{job_request}','destroy')->name('destroy');
                Route::post('edit/{job_request}/preview','editPreview')->name('edit.preview');
                Route::post('{job_request}/preview','updatePreview')->name('update.preview');
                Route::post('{job_request}/draft','updateDraft')->name('update.draft');
            });
            // Route::middleware('can:identify')->group(function () {
                Route::get('create','create')->name('create')->middleware('is_ban');
                Route::post('post/create', 'postCreate')->name('post.create');
                Route::post('store','store')->name('store');
                Route::post('draft','storeDraft')->name('store.draft');
                Route::post('preview','preview')->name('preview');
                Route::post('post/store/preview','storePreview')->name('store.preview');
                Route::view('thanks', 'job_request.thanks')->name('thanks');
            // });
        });

        // 秘訣
        Route::view('secret01','secret.secret01')->name('secret01');
        Route::view('secret02','secret.secret02')->name('secret02');
        Route::view('secret03','secret.secret03')->name('secret03');
        Route::view('secret04','secret.secret04')->name('secret04');
        Route::view('secret05','secret.secret05')->name('secret05');
        Route::view('secret06','secret.secret06')->name('secret06');


        // やり取り（提供・リクエスト共用版）
        Route::prefix('chatroom')->controller(ChatroomController::class)->middleware('null.user.profile')->name('chatroom.')->group(function () {
            Route::get('','index')->name('index');
            Route::get('buyer','buyer')->name('buyer');
            Route::get('active','active')->name('active');
            Route::get('inactive','inactive')->name('inactive');
            Route::post('/update/{chatroom}/trash_flg/', 'updateTrashFlg')->name('update_trash_flg');

            Route::middleware(['product.start.chatroom', 'is_ban'])->group(function () {
                Route::get('product/{product}','newProduct')->name('new.product'); // productからの交渉する
                Route::post('product/{product}', 'createProduct')->name('create.product'); // productからのstart
            });

            Route::middleware(['job_request.start.chatroom', 'is_ban'])->group(function () {
                Route::get('job_request/{job_request}','newJobRequest')->name('new.job_request'); // job_requestから交渉する
                Route::post('job_request/{job_request}', 'createJobRequest')->name('create.job_request'); // job_requestからのstart
            });

            Route::middleware('can:my.chatroom,chatroom')->group(function () {
                Route::get('{chatroom}', 'show')->name('show');
                Route::post('{chatroom}', 'message')->name('message')->middleware('is_ban'); //通常メッセージ
                Route::post('{chatroom}/nda', 'sendNda')->name('send.nda')->middleware('is_ban'); //NDAメッセージ
                Route::post('{chatroom}/nda/edit', 'editOrConclusionNda')->name('send.nda.edit')->middleware('is_ban'); //NDAメッセージ(編集)
                Route::get('{chatroom}/nda/download', 'downloadNda')->name('download.nda.pdf')->middleware('is_ban'); //NDAメッセージpdfダウンロード
            });

            Route::middleware('can:proposal,chatroom')->group(function () {
                Route::post('{chatroom}/proposal','proposal')->name('proposal')->middleware('is_ban'); //提案
                Route::get('{chatroom}/proposal','getProposal')->name('getProposal');
            });

            Route::get('{chatroom}/complete','complete')->middleware('can:worked,chatroom')->name('complete')->middleware('is_ban'); //作業完了

            Route::middleware('can:buyer.evaluation,chatroom')->group(function () {
                Route::get('{chatroom}/buyer_evaluation','getBuyerEvaluation')->name('get.buyer.evaluation'); //購入者価画面
                Route::post('{chatroom}/buyer_evaluation','buyerEvaluation')->name('buyer.evaluation'); //購入者評価
            });

            Route::middleware('can:seller.evaluation,chatroom')->group(function () {
                Route::get('{chatroom}/seller_evaluation','getSellerEvaluation')->name('get.seller.evaluation'); //提供者価画面
                Route::post('{chatroom}/seller_evaluation','sellerEvaluation')->name('seller.evaluation'); //提供者評価
            });

            Route::middleware('can:buyer.cancel.evaluation,chatroom')->group(function () {
                Route::get('{chatroom}/buyer_cancel_evaluation','getBuyerCancelEvaluation')->name('get.buyer.cancel.evaluation'); //購入者価画面
                Route::post('{chatroom}/buyer_cancel_evaluation','buyerCancelEvaluation')->name('buyer.cancel.evaluation'); //購入者評価
            });

            Route::middleware('can:seller.cancel.evaluation,chatroom')->group(function () {
                Route::get('{chatroom}/seller_cancel_evaluation','getSellerCancelEvaluation')->name('get.seller.cancel.evaluation'); //提供者価画面
                Route::post('{chatroom}/seller_cancel_evaluation','sellerCancelEvaluation')->name('seller.cancel.evaluation'); //提供者評価
            });

            // キャンセルした側評価
            Route::middleware('can:cancel.sender.evaluation,chatroom')->group(function () {
                Route::get('{chatroom}/cancel_sender_evaluation','getCancelSenderEvaluation')->name('get.cancel.sender.evaluation'); //購入者価画面
                Route::post('{chatroom}/cancel_sender_evaluation','cancelSenderEvaluation')->name('cancel.sender.evaluation'); //購入者評価
            });

            // キャンセルされた側評価
            Route::middleware('can:cancel.receiver.evaluation,chatroom')->group(function () {
                Route::get('{chatroom}/cancel_receiver_evaluation','getCancelReceiverEvaluation')->name('get.cancel.receiver.evaluation'); //購入者価画面
                Route::post('{chatroom}/cancel_receiver_evaluation','cancelReceiverEvaluation')->name('cancel.receiver.evaluation'); //購入者評価
            });

            Route::get('{chatroom}/evaluation/complete', 'evaluationComplete')->middleware('can:chatroom.evaluation.complete,chatroom')->name('evaluation.complete'); // 評価完了
            // キャンセルした側評価完了
            Route::get('{chatroom}/evaluation/cancel/sender/complete', 'evaluationCancelSenderComplete')->middleware('can:chatroom.evaluation.cancel.sender.complete,chatroom')->name('evaluation.cancel.sender.complete');
            // キャンセルされた側評価完了
            Route::get('{chatroom}/evaluation/cancel/receiver/complete', 'evaluationCancelReceiverComplete')->middleware('can:chatroom.evaluation.cancel.receiver.complete,chatroom')->name('evaluation.cancel.receiver.complete');

            // 支払い
            Route::middleware('deleted_service','can:purchase,proposal')->group(function () {
                Route::get('purchase/{proposal}','purchase')->name('purchase'); //入力画面
                Route::post('purchase/{proposal}','purchaseConfirm')->name('purchase.confirm'); // 確認画面
                Route::post('purchased/{proposal}','purchased')->name('purchased');
            });
            Route::get('purchased/{proposal}','getPurchased')->middleware('can:purchased,proposal')->name('getPurchased');
        });

        Route::get('/purchased_product/{product}', [PurchasedProductController::class, 'show'])->name('purchased_product');
        Route::get('/purchased_job_request/{job_request}', [PurchasedJobRequestController::class, 'show'])->name('purchased_job_request');

        // やりとりキャンセル
        Route::prefix('cancel')->controller(CancelController::class)->name('cancel.')->group(function () {
            Route::middleware('can:cancelable,purchase')->group(function () {
                Route::get('{purchase}', 'create')->name('create'); //申請入力画面
                Route::post('{purchase}', 'store')->name('store'); //キャンセル申請作成
                Route::post('{purchase}/back', 'back')->name('back'); //確認画面から入力画面へ戻る
                Route::post('{purchase}/confirm', 'confirm')->name('confirm'); //確認画面
            });
            Route::get('{purchase}/back', 'backChatroom'); // チャットルームへredirect
            Route::get('{purchase}/confirm', 'backChatroom'); // チャットルームへredirect

            Route::get('{purchased_cancel}/send', 'send')->middleware('can:cancel.send,purchased_cancel')->name('send'); //申請完了画面

            Route::middleware('can:cancel.applying,purchased_cancel')->group(function () {
                Route::get('{purchased_cancel}/show', 'show')->name('show'); //申請内容画面
                Route::post('{purchased_cancel}/approval', 'approval')->name('approval'); //キャンセル承認
                Route::get('{purchased_cancel}/objection', 'objection')->name('objection'); //キャンセル異議申し立て
            });

            Route::get('{purchased_cancel}/approval', 'complete')->middleware('can:canceled,purchased_cancel')->name('complete'); //キャンセル承認画面

        });

        // アンケート
        Route::prefix('survey')->name('survey.')->middleware(['already.answered.karibito_survey','can:survey,chatroom'])->group(function () {
            Route::get('{chatroom}', [KaribitoSurveyController::class, 'create'])->name('create');
            Route::post('{chatroom}', [KaribitoSurveyController::class, 'store'])->name('store');
        });

        // DM
        Route::prefix('dm')->name('dm.')->middleware('null.user.profile')->group(function () {
            Route::get('',[DmroomController::class,'index'])->name('index');
            Route::post('',[DmroomController::class,'store'])->name('store');
            Route::get('{dmroom}',[DmroomController::class,'show'])->middleware('can:my.dm,dmroom')->name('show');
            Route::post('{dmroom}',[DmroomController::class,'message'])->middleware('is_ban')->name('message');
            Route::get('create/{user}',[DmroomController::class,'create'])->middleware(['can:not.create.dm,user','is_ban'])->name('create');
        });

        // フォロー・フォロワー
        Route::prefix('follow')->name('follow.')->middleware('null.user.profile')->group(function () {
            Route::resource('',FollowController::class, ['only' => 'index']);
            Route::get('/add/{id}', [FollowController::class, 'addFollow'])->name('add');
            Route::get('/sub/{id}', [FollowController::class, 'subFollow'])->name('sub');
        });
    });
    // 提供・リクエストの詳細ページ
    Route::get('product/{product}', [MypageProductController::class, 'show'])->name('product.show');
    Route::get('job_request/{job_request}', [MypageJobRequestController::class, 'show'])->name('job_request.show');

    // プライバシーポリシーと運営会社
    Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
    Route::view('/company', 'company')->name('company');
    Route::view('/terms-of-service', 'terms-of-service')->name('terms-of-service');
    Route::view('/notation', 'notation')->name('notation');

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

    // トップ画面のニュース
    Route::get('', [HomeController::class, 'index'])->name('home');
    Route::get('index/news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('news', [NewsController::class, 'index'])->name('news.index');

    //サービス一覧
    Route::get('product/index/category/{category}', [OtherUserProductController::class, 'index'])->name('product.category.index');
    Route::get('product/index/category/show/{child_category}', [OtherUserProductController::class, 'show'])->name('product.category.index.show');
    Route::get('product/index/keyword/search', [OtherUserProductController::class, 'search'])->name('product.search');

    // リクエスト一覧
    Route::get('job_request/index/category/{category}', [OtherUserJobRequestController::class, 'index'])->name('job_request.category.index');
    Route::get('job_request/index/category/show/{child_category}', [OtherUserJobRequestController::class, 'show'])->name('job_request.category.index.show');
    // Route::get('job_request/index/keyword/search', [OtherUserJobRequestController::class, 'search'])->name('job_request.search');

    // ブログ一覧
    Route::get('blog/index/category/{category}', [OtherUserBlogController::class, 'index'])->name('blog.category.index');
    Route::get('blog/index/category/show/{child_category}', [OtherUserBlogController::class, 'show'])->name('blog.category.index.show');

    // --管理者画面-----------------------------------------------------------------------------
    Route::prefix('admin')->name('admin.')->group(function () {

        require __DIR__ . '/admin.php';

        Route::middleware('auth:admin')->group(function () {

            // --最高管理者のみ-----------------------------------------------------------------
            Route::middleware('admin.role')->group(function () {
                Route::resource('/', AdminController::class,['only' => ['index']]);
            });

            Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
            Route::get('/users/search',[UserController::class, 'search'])->name('user.search');
            Route::resource('/users',UserController::class,['only' => ['index', 'show']]);
            Route::resource('/products',ProductController::class,['only' => ['index']]);
            Route::get('/products/search',[ProductController::class, 'search'])->name('product.search');
            Route::resource('/job_requests',JobRequestController::class,['only' => ['index']]);
            Route::get('/job_requests/search',[JobRequestController::class, 'search'])->name('job_request.search');
            Route::resource('/m_commission_rates',MCommissionRateController::class,['only' => ['index', 'store']]);
            Route::resource('/survey',AdminKaribitoSurveyController::class,['only' => ['index']]);
            Route::post('/users/{user}/is_identify',[UserController::class, 'approve'])->name('approve');
            Route::post('/users/{user}/not_identify',[UserController::class, 'revokeApproval'])->name('revokeApproval');
            Route::post('/users/{user}/is_ban',[UserController::class, 'limitAccount'])->name('limit.account');
            Route::post('/users/{user}/not_ban',[UserController::class, 'cancelLimitAccount'])->name('cancel.limit.account');
            Route::resource('/categories', MProductCategoryController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
            Route::resource('/child_categories', MProductChildCategoryController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);

            //お知らせ機能
            Route::resource('/news', AdminNewsController::class);
            ///メモの編集
            Route::put('user/{userId}/update/memo', [UserController::class, 'updateMemo'])->name('user.updateMemo');

            // 決済一覧
            Route::get('/payment',[AdminPaymentController::class, 'index'])->name('payment.index');
            Route::get('/payment/search',[AdminPaymentController::class, 'search'])->name('payment.search');
            Route::post('/payment',[AdminPaymentController::class, 'download'])->name('payment.download');

            // 振込申請
            Route::prefix('transfer_request')->controller(AdminTransferRequestController::class)->name('transfer_request.')->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('/{season}', 'season')->name('season');
                Route::post('', 'csvDownload')->name('download');

                Route::post('/complete', 'complete')->name('complete');
                Route::post('/fail', 'fail')->name('fail');
                Route::post('/back', 'back')->name('back');
            });


        });
    });

    // 未着手
    Route::prefix('sample')->group(function () {
        Route::view('add_category', 'sample.add_category');
        Route::view('contact', 'sample.contact');
        Route::view('estimate', 'sample.estimate');
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
        Route::view('point_history', 'sample.point_history');

    });


    // 該当ユーザーの各ページ
    Route::prefix('user')->middleware('exists_target_user_profile')->name('user.')->group(function () {
        Route::get('{user}/publication',[OtherUserController::class, 'publication'])->name('publication');
        Route::get('{user}/mypage',[OtherUserController::class, 'mypage'])->name('mypage');
        Route::get('{user}/skills',[OtherUserController::class, 'skills'])->name('skills');
        Route::get('{user}/evaluation',[OtherUserController::class, 'evaluation'])->name('evaluation');
        Route::get('{user}/portfolio',[OtherUserController::class, 'portfolio'])->name('portfolio');
        Route::get('{user}/portfolio/{portfolio}',[OtherUserController::class, 'portfolioShow'])->name('portfolio.show');
        Route::get('{user}/blog',[OtherUserController::class, 'blog'])->name('blog');
        Route::get('{user}/blog/{blog}',[OtherUserController::class, 'blogShow'])->name('blog.show');
    });

});
