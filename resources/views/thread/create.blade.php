@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="/threads">
              {{csrf_field()}}
              <div class="form-group">
                <label for="channel_id">Choose a Channel:</label>
                <select name="channel_id" id="channel_id" class="form-control" required>
                  <option value="">Choose One...</option>

                  @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                      {{ $channel->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="title">Тема</label>
                <input type="text" class="form-control" name="title" aria-describedby="helpId" value="{{ old('title') }}" required>
                <small id="helpId" class="form-text text-muted">Help text</small>
              </div>
              <div class="form-group">
                <label for="body">Сообщение</label>
                <textarea class="form-control" name="body" id="body" rows="8" required>{{ old('body') }}</textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать</button>
              </div>
              @if(count($errors))
                <div class="alert alert-warning" role="alert">
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </div>
              @endif
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
