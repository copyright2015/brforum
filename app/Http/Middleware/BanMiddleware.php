<?php

namespace App\Http\Middleware;

use App\Ban;
use Closure;
use Illuminate\Support\Facades\Hash;

class BanMiddleware
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
        $bans = Ban::where('ip_hash',$request->ip())->get();
        foreach ($bans as $ban){
            if($ban->is_404_ban == true && $ban->expire_time > now()){
                abort(404);
            }
        }

        return $next($request);
    }
}
