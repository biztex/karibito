<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class ExistsTargetUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(UserProfile::where([
            ['user_id', '=', $request->user->id],
            ['first_name', '<>', null],
        ])
            ->exists()){
            return $next($request);
        }

        return redirect()->route('home');
    }
}
