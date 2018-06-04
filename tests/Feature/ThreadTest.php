<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
  use DatabaseMigrations;

  public function SetUp()
  {
    parent::SetUp();
    $this->thread = factory('App\Thread')->create();
  }

  public function test_a_user_can_view_all_threads()
  {
    $this->get('/threads')
      ->assertSee($this->thread->title);
  }

  public function test_a_user_can_read_a_single_thread()
  {
    $this->get($this->thread->path())
      ->assertSee($this->thread->body);
  }

  public function test_a_thread_can_make_a_sting_path()
  {
    $this->assertEquals("/threads/{$this->thread->channel->code}/{$this->thread->id}", $this->thread->path());
  }

  public function test_a_user_can_browse_replies()
  {
    $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
    $this->get($this->thread->path())
      ->assertSee($reply->body);
  }

  function test_a_user_can_filter_threads_according_to_a_channel()
  {
    $channel = create('App\Channel');
    $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
    $threadNotInChannel = create('App\Thread');

    $this->get('/threads/' . $channel->code)
      ->assertSee($threadInChannel->title)
      ->assertDontSee($threadNotInChannel->title);
  }

}
