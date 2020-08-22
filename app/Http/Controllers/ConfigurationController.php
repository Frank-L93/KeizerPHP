<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use App\Helpers\ConfigurationManager;
use App\Helpers\InstalledFileManager;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Config;

class ConfigurationController extends Controller
{
    /**
     * @var ConfigurationManager
     */
    protected $ConfigurationManager;

    /**
     * @param ConfigurationManager $environmentManager
     */
    public function __construct(ConfigurationManager $configurationManager)
    {
        $this->ConfigruationManager = $configurationManager;
    }

    /**
     * Display the admin page.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        return view('vendor.installer.admin');
        
    }

    public function configs()
    {
        
        return view('vendor.installer.config');
    }

    // Save the configurations from the installer and finish the installer with updating the installed file
    public function saveConfigs(Redirector $redirect, Request $request, InstalledFileManager $fileManager)
    {

        Config::create([
        'RoundsBetween_Bye' => $request->input('RoundsBetween_Bye'),
        'RoundsBetween' => $request->input('RoundsBetween'),
        'Name' => $request->input('name'),
        'Season' => $request->input('Season'),
        'Club' => $request->input('Club'),
        'Personal' => $request->input('Personal'),
        'Presence' => $request->input('Presence'),
        'Start' => $request->input('Start'),
        'Step' => $request->input('Step'),
        'Other' => $request->input('Other'),
        'Bye' => $request->input('Bye'),
        'EndSeason' => $request->input('EndSeason'),
        'Admin' => $request->input('Admin'),
        'AbsenceMax' => $request->input('AbsenceMax'),
        ]);

        $finalStatusMessage = $fileManager->update();
        return $redirect->route('installed');
    }

    public function registerAdmin(Request $request, Redirector $redirect)
    {
       User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'knsb_id' => $request->knsb_id,
            'rating' => $request->rating,
            'beschikbaar' => $request->beschikbaar,
            'api_token' => Str::random(10),
            'settings' => ["notifications"=>"0"],
            'activate' => 0,
            'rechten' => 2,
        ]);
        return $redirect->route('LaravelInstaller::configs');
    }
}
