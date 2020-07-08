<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Game;
use App\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/{name}/{password}', function (request $request) {
    $userData = Array();
    $user_logging_in = User::where('name', $request->name)->first();
   
        if(Hash::check($request->password, $user_logging_in->password))
        {
            if($user_logging_in->api_token == "")
            {
                $user_logging_in->api_token = "API_DePion";
            }
            array_push($userData, ["id" => $user_logging_in->id, "name" => $user_logging_in->name, "email" => $user_logging_in->email, "api_token" => $user_logging_in->api_token]);
        }
        else
        {
            return false;
        }
    return response()->json($userData);
});
Route::middleware('auth:api')->post('/game/{player}', function (request $request)
{  
        $user = User::where('name', $request->player)->first();

        $games_to_show = Array();
        $games = Game::where('white', $user->id)->orWhere('black', $user->id)->get();
        foreach($games as $game)
        {
            $white = User::where('id', $game->white)->first();
            $white_name = $white->name;

            if($game->result != "Afwezigheid")
            {
                if($game->black != "Bye")
                {
                    $black = User::where('id', $game->black)->first();
                    $black_name = $black->name;
                }
                else
                {
                    $black_name = "Bye";
                }
            }
            else
            {
                $black_name = $game->black;
            }
            array_push($games_to_show, ["id" => $game->id, "white" => $white_name, "black" => $black_name, "result" => $game->result, "round" => $game->round_id]);
        }
        return response()->json($games_to_show);
});
