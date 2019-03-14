<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Verified
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
        if(Auth::user() && Auth::user()->status !== 'active'){
            return redirect()->route('under-review');
        }
        return $next($request);
    }
}
