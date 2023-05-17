<?php

namespace App\Http\Middleware;

use App\Http\Controllers\traid\forsitesetting;
use Closure;

class Chatison
{
    use forsitesetting;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->is_chat_on()){
            return $next($request);
        }else{
             abort(404);
        }
    }
}
