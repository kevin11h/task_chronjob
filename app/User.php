<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
        return $this->hasMany('App\Product','user_id','id');
    }

//    --------------------------------------------------
    public function messagesfun()
    {
        return $this->hasMany('App\Messages','from_id');
    }

    public function friends()
    {
        return $this->hasMany('App\FriendRequest','from_id');
    }
    //    --------------------------------------------------



    public function messages()
    {
        return $this->hasMany('App\Messages','from_id');
    }

    public function messagesCount()
    {
        return $this->messages()
            ->where('show_sms', 0)->where('to_id', Auth::user()->id);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

}
