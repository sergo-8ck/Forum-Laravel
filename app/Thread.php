<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
  use RecordsActivity;

  protected $guarded = []; // https://youtu.be/A32Bw-FQMrU?t=721

  protected $with = ['creator', 'channel'];

  protected static function boot()
  {
    /**
     *
     */
    parent::boot();

    static::addGlobalScope('replyCount', function ($builder){
      $builder->withCount('replies');
    });

    static::deleting(function($thread){
      $thread->replies()->delete();
    });
  }



  /**
   * @return string
   */
  function path()
  {
    return "/threads/{$this->channel->code}/{$this->id}";
  }

  /**
   * A thread may have many replies
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  function replies()
  {
    return $this->hasMany(Reply::class);
  }

  /**
   * Add reply to the thread
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  function creator()
  {
    return $this->belongsTo(User::class, 'user_id'); //thread_id
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  function channel()
  {
    return $this->belongsTo(Channel::class); //channel_id
  }

  /**
   * @param $reply
   * @return Model
   */
  function addReply($reply)
  {
    return $this->replies()->create($reply);
  }

  /**
   * @param $query
   * @param $filters
   * @return mixed
   */
  public function scopeFilter($query, $filters)
  {
    return $filters->apply($query);
  }

}
