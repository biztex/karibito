<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExistUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(UserProfile::where([
            ['user_id', '=', Auth::id()],
            ['first_name', '<>', null],
        ])
            ->exists()){
            return redirect()->route('mypage');
        }
        return $next($request);
    }
}
