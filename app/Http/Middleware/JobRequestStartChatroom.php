<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Chatroom;
use Carbon\Carbon;

class JobRequestStartChatroom
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
        $deadline = new Carbon(date("Y-m-d",strtotime("$request->job_request->application_deadline")));
        $today = new Carbon('today');

        if($request->job_request->user_id === \Auth::id()) {
            return redirect()->route('job_request.show', $request->job_request->id);
        }elseif(Chatroom::requested($request->job_request->id)) {
            return redirect()->route('job_request.show', $request->job_request->id)->with('flash_msg','この商品は売り切れています。ユーザーにDMでお問い合わせください。');
        }elseif($deadline->gt($today)){
            return redirect()->route('job_request.show', $request->job_request->id)->with('flash_msg','期限切れのリクエストです。ユーザーにDMでお問い合わせください。');
        }
        return $next($request);
    }
}
