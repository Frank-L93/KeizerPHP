<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Config;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('App\Settings', function() {
            if(auth()->guest())
            {
                $standard_settings = Array();
                $standard_settings = json_encode(["layout" => "app"]);
                return $standard_settings;
            }
            else
            {
                $user = auth()->user()->id;
                if(User::find($user)->settings == 0)
                {
                   User::find($user)->update(['settings' => ["layout"=>"app"]]);
                 
                }
                return User::find($user)->settings();
            }
        });

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
