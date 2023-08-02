<?php

namespace App\Http\Controllers\Auth;

use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\AlphaRule;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'confirmed', 'string', 'email', 'max:128', 'unique:users'],
            'password' => ['required', 'confirmed','between:8,100', Rules\Password::defaults()->mixedCase()->numbers(), new AlphaRule],
            'terms' => 'required',
            'over_15' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verifyemail_send_at' => Carbon::now()
        ]);

        // シェアされたurlであればクエリパラメータに紹介者のidが含まれる
        $introduced_user_id = $request->input('introduced_user_id');

        event(new Registered($user, $introduced_user_id));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        \Session::put('send_msg','メールを送信しました。'); 
        
        return $request->has('introduced_user_id')
            ? redirect()->route('verification.notice', ['introduced_user_id' => $introduced_user_id])
            : redirect()->route('verification.notice');
    }
}
