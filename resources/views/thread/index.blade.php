@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header bg-transparent">
                        Темы
                    </h5>
                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                <div class="level">
                                    <h4 class="flex"><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                                    <a href="{{$thread->path()}}">
                                        Ответов: {{$thread->replies_count}}
                                    </a>
                                </div>
                                <div class="body">
                                    <p>{{ $thread->body }}</p>
                                </div>
                                <hr>
                            </article>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
