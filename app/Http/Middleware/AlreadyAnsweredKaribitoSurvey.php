<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\KaribitoSurvey;

class AlreadyAnsweredKaribitoSurvey
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
        
        $survey = KaribitoSurvey::firstWhere([
            ['user_id',\Auth::id()],
            ['chatroom_id', $request->chatroom->id],
        ]);
        if($survey){
            return redirect()->route('chatroom.show', $request->chatroom->id)->with('flash_msg','アンケートは回答済みです。');
        };
        return $next($request);
    }
}
