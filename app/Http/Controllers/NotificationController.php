<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

use App\User;
class NotificationController extends Controller
{
   public function showAllNotification(){

    $notifications = auth()->user()->notifications()->orderBy('created_at','desc')->get();

//     foreach( $notifications as $one){
//     }
//   return $one->data['user'];

    return view('notification/AllNotification')->with('notifications',$notifications);
   }

   public function showAllNotificationForUser(){

      $notifications = auth()->user()->notifications()->orderBy('created_at','desc')->get();
  
      return view('notification/AllNotificationForUser')->with('notifications',$notifications);
     }
}
