@extends('layouts.app')

@section('title')
News
@endsection

@section('content')
<div id="news" class="big-bg">
  @include('admin.share.home_header')

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
    <img src="/storage/article-images/{{ $post->post_image_name }}" alt="ライブの様子等">
    <p>{!! nl2br(e( $post->body )) !!}</p>
    @endforeach
  </article>

  <aside>
    <h3 class="sub-title">カテゴリー</h3>
    <ul class="sub-menu">
      <li><a href="">{{ $category_name }}</a></li>
    </ul>

    @foreach($sub_titles as $sub_title)
    <h3 class="sub-title">{{ $sub_title->sub_title }}</h3>
    <p>{!! nl2br(e( $sub_title->description )) !!}</p>
    @endforeach
  </aside>
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
