<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
  protected $guarded = []; // https://youtu.be/A32Bw-FQMrU?t=721

  function path()
  {
    return "/threads/{$this->channel->code}/{$this->id}";
  }

  function replies()
  {
    return $this->hasMany(Reply::class); //thread_id +_id
  }

  function creator()
  {
    return $this->belongsTo(User::class, 'user_id'); //thread_id
  }

  function channel()
  {
    return $this->belongsTo(Channel::class); //channel_id
  }

  function addReply($reply)
  {
    return $this->replies()->create($reply);
  }
}
