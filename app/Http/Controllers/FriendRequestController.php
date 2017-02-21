<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use App\Friends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendRequestController extends Controller
{

    public function index(Request $request)
    {
        $auth_user_id    = $request['auth_user_id'];
        $send_request_id = $request['send_request_id'];
//      dd($auth_user_id.' **->** '.$send_request_id);

        FriendRequest::insert(['from_id'=>$auth_user_id,'to_id'=>$send_request_id]);

     return redirect()->route('/profile');
    }

    public function addFriend(Request $request)
    {
        $data_id = $request->data_id;
        $response = $request->response;
//        dd('--$user_id = '.$user_id.'--$to_id = '.$to_id,'--$auth=='.$auth);
        if($response == 'Yes'){
            FriendRequest::where(['to_id'=>Auth::user()->id,'from_id'=>$data_id])->update(['status'=>'1']);
            echo 'yes';exit;
        }
        if ($response == 'No')
            FriendRequest::where(['to_id'=>Auth::user()->id,'from_id'=>$data_id])->update(['status'=>'0']);
        echo 'no';exit;
    }

    public function friendDel(Request $request)
    {
//        dd($request->to_id);
        $to_id = $request->to_id;
        $from_id = $request->from_id;
        $my_id = $request->my_id;
        $response = $request->response;

        if($response == 'Delete' and $to_id != $my_id){
            FriendRequest::where(['from_id'=>$my_id,'to_id'=>$to_id])->delete();
            FriendRequest::where(['from_id'=>$to_id,'to_id'=>$my_id])->delete();
                echo '1';exit;
        }elseif ($response == 'Delete' and $to_id == $my_id){

            FriendRequest::where(['from_id'=>$my_id,'to_id'=>$from_id])->delete();
            FriendRequest::where(['from_id'=>$to_id,'to_id'=>$my_id])->delete();
            echo '1';exit;

        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
