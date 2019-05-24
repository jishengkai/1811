<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
//        dd(!$request->session()->get('user_id'));
        if(!$request->session()->get('user_id')){
           return redirect()->to('/');
        }
        return $next($request);
    }
}
