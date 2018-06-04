@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <article>
                            <h2 class="card-title">{{ $thread->title }}</h2>
                            <p class="card-text">{{ $thread->body }}</p>
                            <p class="card-text"><a href="">{{ $thread->creator->name }}</a>, <small class="text-muted">{{ $thread->created_at->diffForHumans() }}</small></p>

                        </article>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center py-4">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('thread.reply')
                @endforeach
            </div>
        </div>
        @if(auth()->check())
        <div class="row justify-content-center py-4">
            <div class="col-md-8 col-md-offset-2">
                <h3>Ответить</h3>
                <form method="POST" action="{{ route('post.reply',[$thread->channel->id, $thread->id]) }}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for=""></label>
                        <textarea class="form-control" name="body" id="" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
        @endif
    </div>
@endsection
