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

  function test_a_user_can_filter_threads_by_any_username()
  {
    $this->signIn(create('App\User', ['name' => 'Sergo']));

    $threadBySergo = create('App\Thread', ['user_id' => auth()->id()]);
    $threadNotBySergo = create('App\Thread');

    $this->get('threads?by=Sergo')
      ->assertSee($threadBySergo->title)
      ->assertDontSee($threadNotBySergo->title);
  }

  function test_a_user_can_filter_threads_by_popularity()
  {
    //Given we hae three threads



    //With 2 replies, 3 replies, and 0 replies, respectively.
    $threadWithTwoReplies = create('App\Thread');
    create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

    $threadWithThreeReplies = create('App\Thread');
    create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

    $threadWithNoReplies = $this->thread;


    //When I filter all threads by pupularity
    $response = $this->getJson('threads?popular=1')->json();

    //Then they should be returned from most replies to least.
    $this->assertEquals([3, 2 , 0], array_column($response, 'replies_count'));
  }
}
