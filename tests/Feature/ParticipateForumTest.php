<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateForumTest extends TestCase
{
  use DatabaseMigrations;

  function test_unauth_user_may_paticipate_in_forum_thread()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    //создаем тему
    $thread = factory('App\Thread')->create();
    //создаем ответ и записываем в БД
    $reply = factory('App\Reply')->make();
    $this->post($thread->path() . '/replies', $reply->toArray());

  }

  function test_user_may_paticipate_in_forum_thread()
  {
    //получаем юзера
    $user = factory('App\User')->create();
    $this->be($user);
    //создаем тему
    $thread = factory('App\Thread')->create();
    //создаем ответ и записываем в БД
    $reply = factory('App\Reply')->make();
    $this->post($thread->path() . '/replies', $reply->toArray());
    //проверить вывод
    $this->get($thread->path())
      ->assertSee($reply->body);
  }

  function test_a_reply_requires_a_body ()
  {
    $this->withExceptionHandling()->signIn();

    $thread = create('App\Thread');
    $reply = make('App\Reply', ['body' => null]);

    $this->post($thread->path() . '/replies', $reply->toArray())
    ->assertSessionHasErrors('body');
  }
}
