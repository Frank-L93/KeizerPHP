<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The application's main controller.
     *
     * This controller controls the main pages of the application.
     *
     * It depends on data from the other controllers and models.
     */

     public function index()
     {
         // When this function is called, it will show the index-page
         if(auth()->check())
         {
             return redirect()->to('/dashboard');
         }
         else {
             return view('index');
         }
     }

    public function dashboard()
    {
        //The index page has a component for the Dashboard and the User  Menu after logging in.

        return view('dashboard');
    }

    public function about()
     {
         return view('about');
     }

     public function clubRegister()
     {
         return view('clubRegister');
     }
}
