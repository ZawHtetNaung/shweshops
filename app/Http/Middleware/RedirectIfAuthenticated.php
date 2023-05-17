<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == 'super_admin') {
            if (Auth::guard('super_admin')->check()){
               return redirect(RouteServiceProvider::SUPERADMIN);
            }
        }
        if ($guard == 'shop_owner') {
            if($request->from == 'fromhelpandsupport'){
                if (Auth::guard('shop_owner')->check()) {
                    return redirect(url('backside/shop_owner/support'));
                }
            }else{
                if (Auth::guard('shop_owner')->check()) {
                    return redirect()->route('backside.shop_owner.index');
                }
            }

        }
        if ($guard == 'shop_role') {
            if (Auth::guard('shop_role')->check()) {
                return redirect()->route('backside.shop_owner.index');
            }
        }
        if ($guard == 'user') {
            if (Auth::guard('user')->check()) {
                return redirect()->route('/');
            }
        }
         return $next($request);
    }
}
