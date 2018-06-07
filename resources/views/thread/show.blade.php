@extends('layouts.app')

@section('content')
  <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <div class="level">
                <div class="flex">
                  <h2 class="card-title">{{ $thread->title }}</h2>
                </div>
                @can ('update', $thread)
                  <form action="{{ $thread->path() }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-link">Удалить тему</button>
                  </form>
                @endcan
              </div>

            </div>
            <div class="card-body">
              <article>

                <p class="card-text">{!! $thread->body !!}</p>
                <p class="card-text">
                  <small class="text-muted"><a
                        href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                    - {{ $thread->created_at->diffForHumans() }}</small>
                </p>

              </article>
            </div>
          </div>

          <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

          {{--@foreach($replies as $reply)--}}
          {{--@include('thread.reply')--}}
          {{--@endforeach--}}

          {{--{{$replies->links()}}--}}

          @if(auth()->check())
            <h3>Ответить</h3>
            <form method="POST" action="{{ route('post.reply',[$thread->channel->id, $thread->id]) }}">
              {{csrf_field()}}
              <div class="form-group">
                <label for=""></label>
                <textarea class="form-control" name="body" id="" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
          @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
            </p>
          @endif
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              Эта тема была опубликована {{ $thread->created_at->diffForHumans() }} автор -
              <a href="#">{{ $thread->creator->name }}</a>, и имеет ответов - <span v-text="repliesCount"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </thread-view>
@endsection
