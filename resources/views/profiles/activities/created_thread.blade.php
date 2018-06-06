@component('profiles.activities.activity')
  @slot('heading')
    {{ $profileUser->name }} создал тему
    <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
  @endslot

  @slot('body')
    {!! $activity->subject->body !!}
  @endslot
@endcomponent