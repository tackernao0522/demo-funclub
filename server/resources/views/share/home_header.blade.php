<header class="page-header wrapper">
  <h1><a href="/"><img class="logo" src="/images/logo.png" alt="WCBカフェホーム"></a></h1>
  <nav>
    <ul class="main-nav">
      @if ( Auth::check() && Auth::user()->role === 'admin' )
      <li><a href="{{ route('posts.index') }}">News</a></li>
      @else
      <li><a href="{{ route('articles.index') }}">News</a></li>
      @endif
      @if ( Auth::check() && Auth::user()->role === 'admin' )
      <li><a href="{{ route('info.index') }}">Info</a></li>
      @else
      <li><a href="{{ route('informations.index') }}">Info</a></li>
      @endif
      <li><a href="{{ route('contact.form') }}">Contact</a></li>
    </ul>
  </nav>
</header>
