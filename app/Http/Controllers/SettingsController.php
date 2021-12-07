<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $Settings = Setting::find($request->id);
        foreach ($request->request as $key => $item) {
            if ($key == "notifications") {
                // Check if RSS-link is necessary to generate.
                if ($item > 2) {
                    if (User::find($Settings->user_id)->getRSSLink() == NULL) {
                        // A RSS-Link is necessary to generate.
                        $User = User::find($Settings->user_id);
                        $User->api_token = Str::random(8);
                        $User->save();
                    }
                    $Settings->rss = 1;
                } else {
                    $Settings->rss = 0;
                }
            }
            $Settings->$key = $item;
        }
        $Settings->save();

        return redirect('/settings')->with('success', 'Instellingen aangepast.');
    }
}
