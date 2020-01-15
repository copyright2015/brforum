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
        $userIP = Hash::make($request->ip());
        $ban = Ban::where('ip_hash',$userIP)->get()->first();
        if($ban != null){
            if($ban->is_404_ban){
                abort(404);
            }
        }
        return $next($request);
    }
}
