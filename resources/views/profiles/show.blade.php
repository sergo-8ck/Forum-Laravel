@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card-header">
          <h1>
            {{ $profileUser->name }}
          </h1>
        </div>

        @foreach ($activities as $date => $activity)
          <h3 class="card-header">{{ $date }}</h3>

          @foreach ($activity as $record)
            @include ("profiles.activities.{$record->type}", ['activity' => $record])
          @endforeach
        @endforeach
      </div>
    </div>
  </div>
@endsection