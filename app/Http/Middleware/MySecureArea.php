<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MySecureArea
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
        if(1==1){
            return redirect('https://www.google.com');
        }

        return $next($request);
    }
}
