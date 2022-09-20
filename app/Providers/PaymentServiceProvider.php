<?php

namespace App\Providers;

use App\Libraries\Payment\StripePayment;
use App\Libraries\Payment\PaymentInterface;
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
        // envにstripeの設定の有無によってインスタンスを変更
        if(config('stripe.stripe_secret_key')){
            // あり：StripePaymentを注入
            $this->app->bind(PaymentInterface::class, function ($app) {
                return new StripePayment();
            });
        } else {
            // なし：StubPaymentを注入
            $this->app->singleton(PaymentInterface::class, function ($app) {
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
