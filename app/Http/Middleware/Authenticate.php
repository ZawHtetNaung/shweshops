<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
         return route('front'); 
      
        // if (! $request->expectsJson()) {
        //     if(!Auth::guard('super_admin')->check()){
        //         return redirect('/');

        //     }else{
        //         if(!Auth::guard('shop_owner')->check()){
        //             return route('backside.shop_owner.login');

        //         }else{
        //             return route('login');

        //         }

        //     }
        // }


    }
}
