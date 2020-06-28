<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use App\Settings;
Use App\Config;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index(){
        $settings = app('App\Settings');
        
       
        return view('pages.index');
    }
    
    public function about(){
        return view('pages.about');
    }

    public function privacy(){
        return view('pages.privacy');
    }
   
}
