<?php



namespace App;

trait Favoritable
{

  /**
   * Boot the trait.
   */
  protected static function bootFavoritable()
  {
    static::deleting(function ($model) {
      $model->favorites->each->delete();
    });
  }

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
    if (! $this->favorites()->where($attributes)->exists()) {
      return $this->favorites()->create($attributes);
    }
  }

  /**
   * Unfavorite the current reply.
   */
  public function unfavorite()
  {
    $attributes = ['user_id' => auth()->id()];

    $this->favorites()->where($attributes)->delete();
  }

  public function isFavorited()
  {
    return !!$this->favorites->where('user_id', auth()->id())->count();
  }

  /**
   * Fetch the favorited status as a property.
   *
   * @return bool
   */
  public function getIsFavoritedAttribute()
  {
    return $this->isFavorited();
  }

  public function getFavoritesCountAttribute()
  {
    return $this->favorites->count();
  }
}