<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\User;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
            User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
