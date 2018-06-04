@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                <h4><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                                <p>{{ $thread->body }}</p>
                                <hr>
                            </article>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
