<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyJobRequestStartChatroom
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
        if($request->job_request->user_id === \Auth::id()) {
            return redirect()->route('job_request.show', $request->job_request->id);
        }
        return $next($request);
    }
}
