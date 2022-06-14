<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
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
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:24'],
            'email' => ['required','confirmed', 'string', 'email', 'max:128', 'unique:admins'],
            'password' => ['required', 'confirmed','between:8,100', Rules\Password::defaults(), new AlphaRule],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'verifyemail_send_at' => Carbon::now()
        ])->save();

        
        event(new Registered($user));

        //Auth::guard('admin')->login($user);
        
        return redirect()->route('admin.index')->with('flash_msg','管理者アカウントを新たに作成しました!');
    }
}
