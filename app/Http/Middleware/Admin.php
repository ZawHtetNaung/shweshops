<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(Auth::guard('super_admin')->user()->role == 0 || Auth::guard('super_admin')->user()->role == 1){
           return $next($request);   
        }else{
            Auth::guard('super_admin')->logout();
            return redirect()->back()->with('message','Admin က approve လုပ်ပီးမှ ဝင်လို့ရမည်');
        }
    }
}
