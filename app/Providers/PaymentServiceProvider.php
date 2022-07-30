<?php

namespace App\Providers;

use App\Libraries\Payment\PayjpPayment;
use App\Libraries\Payment\Payment;
use App\Libraries\Payment\StubPayment;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // envにpayjpの設定の有無によってインスタンスを変更
        if(config('payjp.secret_key')){
            // あり：PayjpPaymentを注入
            $this->app->bind(Payment::class, function ($app) {
                return new PayjpPayment();
            });
        } else {
            // なし：StubPaymentを注入
            $this->app->singleton(Payment::class, function ($app) {
                return new StubPayment();
            });
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
