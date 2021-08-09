<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <meata name="description" content="しゅうちゃんバンドのファンクラブサイト"></meata>

    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-25/css/5-1-25.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    @if ( Auth::check() && Auth::user()->role === 'admin' )
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    @else
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    @endif

    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/images/tp.ico') }}">
</head>

<body>
    <div id="app">
        <header id="header-logo">
            <h1 class="main-logo"><a href="/"><img class="logo" src="/images/logo.png" alt="WCBカフェホーム"></a></h1>
        </header>

        <div class="openbtn"><span></span><span></span><span></span></div>
        <nav id="g-nav">
            <div id="g-nav-list">
                <ul>
                    @guest
                    <li><a href="{{ route('login') }}" style="color: #6cb2eb">ログイン</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">初めに無料会員登録</a></li>
                    @endif
                    @else
                    @if ( Auth::check() && Auth::user()->role === 'premium' )
                    <li class="subscription-link premium-link"><a href="{{route('subscription.cancel', Auth::user()->id) }}" class="btn btn-danger">プレミアム会員解約</a></li>
                    @endif
                    @if ( Auth::check() && Auth::user()->role === 'member' )
                    <li class="subscription-link premium-link"><a href="{{ route('stripe.subscription') }}" class="btn btn-success">プレミアム会員(月額1000円)</a></li>
                    @endif
                    @if ( Auth::check() && Auth::user()->role === 'member' )
                    <li>{{ Auth::user()->name }}さん<span> [無料会員]</span></li>
                    @elseif ( Auth::check() && Auth::user()->role === 'premium' )
                    <li>{{ Auth::user()->name }}さん<span> [プレミアム会員]</span></li>
                    @elseif ( Auth::check() && Auth::user()->role === 'admin' )
                    <li>{{ Auth::user()->name }}さん<span> [管理者]</span></li>
                    @else
                    @endif
                    <li><a class="logout-hover" style="color: #0bd" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('ログアウト') }}</a></li>
                    @if ( Auth::check() && Auth::user()->role === 'admin' )
                    <li><a href="{{ route('admin') }}">{{ __('管理者用') }}</a></li>
                    @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endguest
                    @if ( Auth::check() && Auth::user()->role === 'admin' )
                    <li><a href="/">TOP</a></li>
                    <li><a href="{{ route('posts.index') }}">News</a></li>
                    <li><a href="{{ route('info.index') }}">Info</a></li>
                    @else
                    <li><a href="/">TOP</a></li>
                    <li><a href="{{ route('articles.index') }}">News</a></li>
                    <li><a href="{{ route('informations.index') }}">Info</a></li>
                    @endif
                    @if (Auth::check())
                    <li><a href="{{ route('contact.form') }}">Contact</a></li>
                    @endif
                </ul>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/global_header_menu.js') }}"></script>
    </div>
</body>

</html>
