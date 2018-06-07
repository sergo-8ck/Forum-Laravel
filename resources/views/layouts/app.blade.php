<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    body {
      padding-bottom: 100px;
    }

    .level {
      display: flex;
      align-items: center;
    }

    .flex {
      flex: 1;
    }
    .mr-1 { margin-right: 1em; }
    [v-cloak] { display: none; }

  </style>
</head>
<body>
<div id="app">
  @include ('layouts.nav')


  <main class="py-4">
    @yield('content')
  </main>
  <flash message="{{ session('flash') }}"></flash>

</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
@yield('js')
</body>
</html>
