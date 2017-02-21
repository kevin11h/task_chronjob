<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MaddHatter\LaravelFullcalendar\Calendar;
use App\EventModel;
use MaddHatter\LaravelFullcalendar\Event;
use Illuminate\Support\Facades\Auth;
use App\User;

class CalendarController extends Controller{

    public function calendar(Request $request)
    {
        $users = User::select('users.id','users.name','users.avatar','users.birthday','friend_requests.from_id','friend_requests.to_id','friend_requests.created_at','friend_requests.updated_at','friend_requests.status')
            ->leftjoin('friend_requests', function ($join) {
                $join->on('users.id', '=', 'friend_requests.from_id')
                    ->where('friend_requests.to_id', '=',Auth::id())
                    ->orOn('users.id', '=', 'friend_requests.to_id')
                    ->where('friend_requests.from_id', '=',Auth::id());
            })->WHERE('users.id', '!=', Auth::id())->get();

        return response()->Json($users);


    }



}
