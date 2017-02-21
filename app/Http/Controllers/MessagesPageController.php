<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\FriendRequest;
use Illuminate\Support\Facades\Auth;
use App\Messages;
use App\User as Users1;
class MessagesPageController extends Controller
{
    public function index()
    {

        $fun = Users1::all();

        $req_data = User::select('users.id','users.name','users.avatar','friend_requests.from_id','friend_requests.to_id','friend_requests.created_at','friend_requests.updated_at','friend_requests.status')
            ->leftjoin('friend_requests', function ($join) {
                $join->on('users.id', '=', 'friend_requests.from_id')
                    ->where('friend_requests.to_id', '=',Auth::id())
                    ->orOn('users.id', '=', 'friend_requests.to_id')
                    ->where('friend_requests.from_id', '=',Auth::id());
            })->WHERE('users.id', '!=', Auth::id())->get();

        $id = Auth::user()->id;

           // $count = Messages::where('to_id',Auth::user()->id)->where('show_sms','=',0)->get()->toArray();
            //$count = count($count);

//            dd($count);

            $count1 = Users1::with('messagesCount')->get()->toArray();
            $count=[];
            foreach($count1 as $count2){
                if($count2['messages_count'] != []){
                    array_push($count,$count2);
                }
            }
        $user_profile_all_info = User::all();

        return view('messages',['user_profile_all_info'=>$user_profile_all_info,'req_data'=>$req_data,'id'=>$id,'count'=>$count,'fun'=> $fun]);
    }

















}
