<?php

namespace App\Http\Middleware;

use Closure;
use ACL;

class ACLCheck
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
        if(ACL::check() == false){
            abort(404);
        }
        return $next($request);
    }
}
