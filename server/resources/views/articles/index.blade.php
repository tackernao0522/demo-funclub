@extends('layouts.app')

@section('title')
News
@endsection

@section('content')
<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 15px">News</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->

@include('share.status_card')

<div class="news-contents wrapper">
  @include('share.article_contents')
  @include('share.sidebar')
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
