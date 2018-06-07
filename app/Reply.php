<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  use Favoritable, RecordsActivity;


  protected $guarded = []; // https://youtu.be/A32Bw-FQMrU?t=721

  protected $with = ['owner', 'favorites'];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['favoritesCount', 'isFavorited'];

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');//reply_id
  }

  /**
   * A reply belongs to a thread.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function thread()
  {
    return $this->belongsTo(Thread::class);
  }

  /**
   * Determine the path to the reply.
   *
   * @return string
   */
  public function path()
  {
    return $this->thread->path() . "#reply-{$this->id}";
  }
}
