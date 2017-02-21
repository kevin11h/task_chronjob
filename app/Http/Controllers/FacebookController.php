<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use DB;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {

        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();


        $face_user_name = $user->name;
        $face_user_id = $user->id;
        $face_user_image = $user->avatar;

//        dd($user->avatar);


        $f_id = DB::select('select id from users where face_id = :id', ['id' => $face_user_id]);


          if (!empty($f_id)){

             Auth::loginUsingId($f_id[0]->id);

              return redirect()->route('/showtable');



          }else{

            $face_user_id = User::insertGetId(
                ['name' =>$face_user_name, 'face_id' =>$face_user_id,'avatar'=>$face_user_image]
            );
                Auth::loginUsingId($face_user_id);

            return redirect()->route('/showtable');

        }
    }
}
