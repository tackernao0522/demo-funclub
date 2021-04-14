@extends('layouts.app')

@section('title')
News
@endsection

@section('content')
<div id="news" class="big-bg">
  @include('share.home_header')

  <div class="wrapper">
    <h2 class="page-title">News</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->

<div class="news-contents wrapper">
  <article>
    @foreach($posts as $post)
    <header class="post-info">
      <h2 class="post-title">{{ $post->post_title }}</h2>
      <p class="post-date">{{ $post->post_date->format('n/d') }}<span>{{ $post->post_date->format('Y') }}</span></p>
      <p class="post-cat">カテゴリー：{{ $post->primaryCategory->name }}</p>
    </header>
    <img src="/storage/article-images/{{ $post->post_image_name }}" alt="店内の様子">
    <p>
    <p>{!! nl2br(e( $post->body )) !!}</p>
    </p>
    @endforeach
  </article>

  <aside>
    <h3 class="sub-title">カテゴリー</h3>
    <ul class="sub-menu">
      @foreach($categories as $category)
      <li><a href="{{ route('news.category', $category->id) }}">{{ $category->name }}</a></li>
      @endforeach
    </ul>

    <h3 class="sub-title">このお店について</h3>
    <p>
      体に優しい自然食を提供する、WCB CAFE。無添加の食材を利用したメニューが特徴です。
      おいしいブレンドコーヒーとヘルシーなオーガニックフードで体の内側から癒やされてください。
    </p>
  </aside>
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
