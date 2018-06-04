<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
  use DatabaseMigrations;

  function test_unauth_user_can_create_new_thread()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    //создаем тему
//        $thread = factory('App\Thread')->make();
    $thread = make('App\Thread');
    $this->post('/threads', $thread->toArray());
  }

  function test_unauth_user_can_not_see_create_new_thread()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    $this->get('/threads/create')->assertRedirect('/login');
  }

  function test_user_can_create_new_thread()
  {
//    $this->be($user);
    $this->signIn();
    //создаем тему
//    $thread = factory('App\Thread')->make();
    $thread = make('App\Thread');

    $response = $this->post('/threads', $thread->toArray());


    //проверить вывод
    $this->get($response->headers->get('Location'))
      ->assertSee($thread->title)
      ->assertSee($thread->body);
  }

  function test_a_thread_requires_a_title()
  {
    $this->publishThread(['title' => null])
      ->assertSessionHasErrors('title');

  }

  function test_a_thread_requires_a_body()
  {
    $this->publishThread(['body' => null])
      ->assertSessionHasErrors('body');

  }

  function test_a_thread_requires_a_valid_channel()
  {
    factory('App\Channel', 2)->create();

    $this->publishThread(['channel_id' => null])
      ->assertSessionHasErrors('channel_id');

    $this->publishThread(['channel_id' => 9999999])
      ->assertSessionHasErrors('channel_id');

  }

  function publishThread($overrides = [])
  {
    $this->withExceptionHandling()->signIn();

    $thread = make('App\Thread', $overrides);

    return $this->post('/threads', $thread->toArray());
  }
}
