<?php

namespace App\Http\Controllers;

use Socialite;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        $google_user_name = $user->name;
        $google_user_id = $user->id;
        $avatar = $user->avatar;


        $g_id = DB::select('select id from users where google_user = :id', ['id' => $google_user_id]);


        if (!empty($g_id)){

            Auth::loginUsingId($g_id[0]->id);

            return redirect()->route('/showtable');



        }else{

            $google_user_id = User::insertGetId(
                ['name' =>$google_user_name, 'google_user' =>$google_user_id,'avatar'=>$avatar]
            );

            Auth::loginUsingId($google_user_id);

            return redirect()->route('/showtable');

        }
    }
}
