<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->

      <ul class="navbar-nav mr-auto">
        {{--<li class="nav-item">--}}
        {{--<a href="/threads" class="nav-link active">All Threads</a>--}}
        {{--</li>--}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
             aria-haspopup="true" aria-expanded="false">Темы<span class="caret"></span></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="/threads">Все Темы</a>
            @if(auth()->check())
              <a class="dropdown-item" href="/threads?by={{ auth()->user()->name }}">Мои Темы</a>
            @endif

            <a class="dropdown-item" href="/threads?popular=1">Популярные</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
             aria-haspopup="true" aria-expanded="false">Категории <span class="caret"></span></a>
          <div class="dropdown-menu">
            @foreach ($channels as $channel)
              <a class="dropdown-item" href="/threads/{{ $channel->code }}">{{ $channel->name }}</a>
            @endforeach
          </div>
        </li>
        <li class="nav-item">
          <a href="/threads/create" class="nav-link">Создать тему</a>
        </li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
          <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">Профиль</a>

              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>