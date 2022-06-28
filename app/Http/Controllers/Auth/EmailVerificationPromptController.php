<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $error = \Session::get('error_msg');
        $send_msg = \Session::get('send_msg');
        return $request->user()->hasVerifiedEmail()
                    // ? redirect()->intended(RouteServiceProvider::HOME)
                    ? redirect()->route('user_profile.create')
                    : view('auth.verify-email',compact('error','send_msg'));
    }
}
