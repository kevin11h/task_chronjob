<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'from_id', 'to_id','sms','created_at','file_name','show_sms'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
