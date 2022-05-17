<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExistsSessionFacebookId
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
        $response = $next($request);

        $existsFacebookId = \Session::has('facebookId');
        $validationError = \Session::has('errors');

        // facebookIdがセッションになければ404
        if (!$existsFacebookId) {

            // セッションIDがなくてもバリデーションエラーがあれば通す
            if ($validationError) {
                return $response;
            }

            abort(404);
        }

        return $response;
        return $next($request);
    }
}
