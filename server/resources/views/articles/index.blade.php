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
  @include('share.article_contents')

  <aside>
    <h3 class="sub-title">カテゴリー</h3>
    <ul class="sub-menu">
      @foreach($categories as $category)
      <li><a href="{{ route('news.category', $category->id) }}">{{ $category->name }}</a></li>
      @endforeach
    </ul>

    @foreach($sub_titles as $sub_title)
    <h3 class="sub-title">{{ $sub_title->sub_title }}</h3>
    <p>{!! nl2br(e( $sub_title->description )) !!}</p>
    @endforeach
  </aside>
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
