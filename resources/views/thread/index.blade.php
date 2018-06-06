@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @forelse($threads as $thread)
          <div class="card my-4">
            <div class="card-header bg-transparent">
              <div class="level">
                <h4 class="flex"><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                <a href="{{$thread->path()}}">
                  Ответов: {{$thread->replies_count}}
                </a>
              </div>
            </div>
            <div class="card-body">
              <article>

                <div class="body">
                  <p>{!! $thread->body !!} </p>
                </div>
                <hr>
              </article>
            </div>
          </div>
        @empty
          <p>Тут не создано еще ни одной темы.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection
