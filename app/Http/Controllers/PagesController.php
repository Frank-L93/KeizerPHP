<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use App\Settings;
Use App\Config;

class PagesController extends Controller
{

    public function index(){
        $settings = app('App\Settings');
        
        if((Auth::check()) && (auth()->user()->active == 0))
        {
            $errors = ['activation_response' => 'Je hebt geen actief account. ' . link_to(url('activation'), 'Klik hier') . ' om je account te activeren'];
            Auth::logout();
            return redirect('/login')->withErrors($errors);
           
        }
        return view('pages.index');
    }
    
    public function about(){
        return view('pages.about');
    }

    public function privacy(){
        return view('pages.privacy');
    }
   
}
