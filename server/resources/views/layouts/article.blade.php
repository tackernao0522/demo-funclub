<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  @yield('styles')
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-25/css/5-1-25.css">
  <link rel="shortcut icon" href="{{ asset('/images/tp.ico') }}">
</head>

<body>
  <header id="header-logo">
    <h1 class="main-logo"><a href="/"><img class="logo" src="/images/logo.png" alt="WCBカフェホーム"></a></h1>
  </header>

  <div class="openbtn"><span></span><span></span><span></span></div>
  <nav id="g-nav">
    <div id="g-nav-list">
      <ul>
        <li>{{ Auth::user()->name }}さん<span> [管理者]</span></li>
        <li><a class="logout-hover" style="color: #0bd" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">{{ __('ログアウト') }}</a></li>
        <li><a href="{{ route('admin') }}">{{ __('管理者用') }}</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <li><a href="/">TOP</a></li>
        <li><a href="{{ route('posts.index') }}">News</a></li>
        <li><a href="{{ route('info.index') }}">Info</a></li>
        <li><a href="{{ route('items.index') }}">Online Shop</a></li>
        <li><a href="{{ route('contact.form') }}">Contact</a></li>
      </ul>
    </div>
  </nav>
  <main>
    @yield('content')
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="{{ mix('js/global_header_menu.js') }}"></script>
  @yield('scripts')
</body>

</html>
