<?php
namespace App\Http\Controllers;

use App\Events\ClubCreated;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Club;
class ClubController extends BaseController
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function registerClub(Request $request): string
    {
        $newClub = Club::create([
            'name' => $request->Club,
            'contact' => $request->Contact,

        ]);

        ClubCreated::dispatch($newClub, $request);
        return redirect()->to('/')->with('success', trans('messages.club.created'));
    }
}
