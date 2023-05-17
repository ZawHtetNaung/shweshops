<?php

namespace App\Http\Middleware;

use App\Http\Controllers\traid\UserRole;

use App\Featuresforshops;
use App\sitesettings;
use Closure;

class Canusepos
{
    use UserRole;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $checkpos = Featuresforshops::where([['shop_id', '=', $this->getshopid()], ['feature', '=', 'pos']])->first();
        $sitesetting = sitesettings::where('name', 'pos')->first();
        if ($sitesetting->action == 'on') {


            if (!empty($checkpos)) {
                return $next($request);

            } else {
                abort(401);
            }
        } else {
            abort(401);

        }
    }
}
