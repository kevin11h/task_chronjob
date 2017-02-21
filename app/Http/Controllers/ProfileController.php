<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\FriendRequest;
use Illuminate\Support\Facades\Auth;
use App\Messages;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $req_data = User::select('users.id','users.name','users.avatar','friend_requests.from_id','friend_requests.to_id','friend_requests.created_at','friend_requests.updated_at','friend_requests.status')
            ->leftjoin('friend_requests', function ($join) {
                $join->on('users.id', '=', 'friend_requests.from_id')
                    ->where('friend_requests.to_id', '=',Auth::id())
                    ->orOn('users.id', '=', 'friend_requests.to_id')
                        ->where('friend_requests.from_id', '=',Auth::id());
            })->WHERE('users.id', '!=', Auth::id())->paginate(10);

        $user_profile_all_info = User::all();

//        $count = Messages::where('to_id', Auth::user()->id)->where('show_sms',0)
//            ->get()->count();

        $count = Messages::where('to_id',Auth::user()->id)->where('show_sms','=',0)->get()->toArray();
        $count = count($count);

        return view('my_profile',['user_profile_all_info'=>$user_profile_all_info,'req_data'=>$req_data,'count'=>$count]);
    }
}
