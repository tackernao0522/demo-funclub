@extends('layouts.app')

@section('title')
News
@endsection

@section('content')
<div class="row article-post">
  <div class="col-8 offset-2">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
  </div>
</div>

<div id="news" class="big-bg">
  @include('admin.share.home_header')

  <div class="wrapper">
    <h2 class="page-title">News</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->

<div class="news-contents wrapper">
  @include('share.article_contents')
  @include('share.sidebar')
</div><!-- /.news-contents -->

@include('share.footer')
@endsection