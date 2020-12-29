<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language
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

        if (is_null(session('locale'))) {
            session(['locale' => "nl"]);
        }
        app()->setLocale(session('locale'));

        return $next($request);
    }
}
