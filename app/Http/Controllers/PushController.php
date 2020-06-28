<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Notifications\PushDemo;
use App\User;
use Auth;
use Notification;

class PushController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
      }
  
      /**
       * Store the PushSubscription.
       * 
       * @param \Illuminate\Http\Request $request
       * @return \Illuminate\Http\JsonResponse
       */
      public function store(Request $request){
          $this->validate($request,[
              'endpoint'    => 'required',
              'keys.auth'   => 'required',
              'keys.p256dh' => 'required'
          ]);
          $endpoint = $request->endpoint;
          $token = $request->keys['auth'];
          $key = $request->keys['p256dh'];
          $user = Auth::user();
          $user->updatePushSubscription($endpoint, $key, $token);
          
          return response()->json(['success' => true],200);
     
     
        }
        /**
        * Send Push Notifications to all users.
        * 
        * @return \Illuminate\Http\Response
        */
        public function push($route, $message, $title, $type){
            
            $num = (int)$type;
            
            // Based on type, determine the users to send notifications
            if($type == 3)
            {
                $users_to_notify = User::where('rechten', '2')->get();
                Notification::send($users_to_notify, new PushDemo($message,$title, $num));
                }
            else{
                // For now send all Users a notificiation
                $users_to_notify = User::all();
                    Notification::send(
                    $users_to_notify,
                    new PushDemo($message, $title, $num)
                );
            
                return redirect()->route($route)->with('Success', 'Push Bericht gestuurd');
            }
        }
}