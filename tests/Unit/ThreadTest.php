<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
  use DatabaseMigrations;

  public function SetUp()
  {
    parent::SetUp();
    $this->thread = factory('App\Thread')->create();
  }

  public function test_a_thread_has_a_creator()
  {
    $this->assertInstanceOf('App\User', $this->thread->creator);
  }

  public function test_a_thread_belongs_to_channel()
  {
    $this->assertInstanceOf('App\Channel', $this->thread->channel);
  }

  public function test_a_thread_can_add_reply()
  {
    $this->thread->addReply([
      'body' => 'cheburek',
      'user_id' => 1
    ]);
    $this->assertCount(1, $this->thread->replies);
  }
}
