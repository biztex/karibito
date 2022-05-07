<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/', function () {
    return redirect('sample/');
//    return view('welcome');
});

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
});