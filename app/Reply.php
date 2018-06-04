<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $guarded = []; // https://youtu.be/A32Bw-FQMrU?t=721

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');//reply_id
    }
}
