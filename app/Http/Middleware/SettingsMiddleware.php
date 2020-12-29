<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Http\Request;
use App;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingsMiddleware
{
    /**
     * Define the language based on our settings or session.
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if(Auth::check())
       {
            $settings = Auth::user()->settings();
           $layout = $settings->layout;
           $notifications = $settings->notifications;
           App::setLayout($layout);
           App::setNotifications($notifications);
           config(['app.name' => Config::CompetitionName()]);

       }



        return $next($request);
    }
}
