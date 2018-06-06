<?php



namespace App;



trait Favoritable
{

  /**
   * A reply can be favorited
   *
   * @return mixed
   */
  public function favorites()
  {
    return $this->morphMany(Favorite::class, 'favorited');
  }

  /**
   * Favorite the currunt reply
   *
   * @return mixed
   */

  public function favorite()
  {
    $attributes = ['user_id' => auth()->id()];
    if (!$this->favorites()->where($attributes)->exists()) {
      return $this->favorites()->create($attributes);
    }
  }

  public function isFavorited()
  {
    return !!$this->favorites->where('user_id', auth()->id())->count();
  }

  public function getFavoritesCountAttribute()
  {
    return $this->favorites->count();
  }
}