<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store($channelId, Thread $thread)
  {
    $this->validate(request(), ['body' => 'required']);

    $thread->addReply([
      'body' => request('body'),
      'user_id' => auth()->id()
    ]);
    return back()->with('flash', 'Ваш ответ добавлен.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Reply $reply
   * @return \Illuminate\Http\Response
   */
  public function show(Reply $reply)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Reply $reply
   * @return \Illuminate\Http\Response
   */
  public function edit(Reply $reply)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \App\Reply $reply
   * @return \Illuminate\Http\Response
   */
  /**
   * Update an existing reply.
   *
   * @param Reply $reply
   */
  public function update(Reply $reply)
  {
    $this->authorize('update', $reply);

    $this->validate(request(), ['body' => 'required']);

    $reply->update(request(['body']));
  }

  /**
   * Delete the given reply.
   *
   * @param  Reply $reply
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Reply $reply)
  {
    $this->authorize('update', $reply);

    $reply->delete();

    return back();
  }
}
