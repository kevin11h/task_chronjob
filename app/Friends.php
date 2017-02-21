<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{

    protected $fillable = [
        'status', 'my_id', 'friend_id',
    ];
}
