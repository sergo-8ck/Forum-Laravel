@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-body">
            <article>
              <h2 class="card-title"> {{ $profileUser->name }}</h2>
              <p class="card-text"><small>{{ $profileUser->created_at->diffForHumans() }}</small></p>
            </article>
          </div>
        </div>


        @foreach ($threads as $thread)
          <div class="card my-2">
            <div class="card-header bg-transparent">
              <div class="level">
           <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> добавил:
             <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
           </span>

                <span>{{ $thread->created_at->diffForHumans() }}</span>
              </div>
            </div>
            <div class="card-body">
              {!! $thread->body !!}
            </div>
          </div>
        @endforeach

        {{ $threads->links() }}
      </div>
    </div>

  </div>
@endsection