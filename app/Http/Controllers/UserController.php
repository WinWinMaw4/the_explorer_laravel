<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    //
    public function userOnlineStatus()
    {
        $users = User::select("*")->whereNotNull('last_seen')->orderBy('last_seen','DESC')->get();

//        foreach ($users as $user) {
//            if (Cache::has('user-is-online-' . $user->id))
//                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
//            else
//                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
//        }
        return view('user.index',[
            'users'=>$users,
        ]);
    }
}
