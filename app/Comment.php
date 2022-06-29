<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    //UN SOLO POST, TANTI COMMENTI 
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
