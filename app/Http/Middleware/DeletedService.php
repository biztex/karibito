<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeletedService
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
        if($request->proposal->chatroom->reference === null) {
            return redirect()->route('chatroom.show', $request->proposal->chatroom->id)->with('flash_msg','商品は削除されました');
        }

        return $next($request);
    }
}
