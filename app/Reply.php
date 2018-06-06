<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  use Favoritable;


  protected $guarded = []; // https://youtu.be/A32Bw-FQMrU?t=721

  protected $with = ['owner', 'favorites'];

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');//reply_id
  }

}
