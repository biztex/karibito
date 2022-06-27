<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NullUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = UserProfile::firstWhere('user_id',Auth::id());

        if(empty($user->first_name)){
            return redirect()->route('user_profile.create');
        };
        return $next($request);
    }
}
