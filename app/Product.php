<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'price','user_id','filename'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
