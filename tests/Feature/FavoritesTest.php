<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{

  use DatabaseMigrations;

  function test_guest_can_not_favorite_anything()
  {
    $this->withExceptionHandling()
      ->post("replies/1/favorites")
      ->assertRedirect('/login');
  }

  /**
   * A basic test example.
   *
   * @return void
   */
  public function test_an_authenticated_user_can_favorite_any_reply()
  {

    $this->signIn();

    // /thread/id/favorites
    $reply = create('App\Reply');

    // If I post to a "favorite" endpoint
    $this->post("replies/{$reply->id}/favorites");

    // It should be recorded in the database.
    $this->assertCount(1, $reply->favorites);

  }

  function test_an_authenticated_user_may_only_favorite_a_reply_once()
  {
    $this->signIn();

    // /thread/id/favorites
    $reply = create('App\Reply');
    try{
      // If I post to a "favorite" endpoint
      $this->post("replies/{$reply->id}/favorites");
      $this->post("replies/{$reply->id}/favorites");
    } catch (\Exception $e){
      $this->fail('Did not expect to insert the same record set twice.');
    }


    // It should be recorded in the database.
    $this->assertCount(1, $reply->favorites);
  }
}
