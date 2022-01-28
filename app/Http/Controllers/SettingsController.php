<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $nieuwPassword = 0;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'alpha'
            ]
        );
        $Settings = Setting::find($request->id);
        $User = User::find($Settings->user_id);

        if (empty($request->newPassword)) {
        } else {
            $request->validate(
                [

                    'oldPassword' => 'required|current_password:auth',
                    'newPassword' => Password::min(8)->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                ]
            );
            $nieuwPassword = 1;
        }


        foreach ($request->request as $key => $item) {

            if ($key == "beschikbaar") {
                $User->beschikbaar = $item;
                $User->save();
            } elseif ($key == "name") {

                $User->name = $item;
                $User->save();
            } elseif ($key == "oldPassword") {
                // Niks mee doen.
            } elseif ($key == "newPassword" && $nieuwPassword == 1) {
                $User->password = Hash::make($request->newPassword);
            } elseif ($key == "newPassword") {
            } else {
                if ($key == "NotifyByRSS") {
                    // Check if RSS-link is necessary to generate.
                    if ($item == true) {
                        if ($User->getRSSLink() == NULL) {
                            // A RSS-Link is necessary to generate.
                            $User->api_token = Str::random(8);
                            $User->save();
                        }
                    }
                }
                $Settings->$key = $item;
            }
        }
        $Settings->save();


        return redirect('/settings')->with('success', 'Instellingen aangepast');
    }
}
