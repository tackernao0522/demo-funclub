@extends('layouts.app')

@section('title')
News(Admin)
@endsection

@section('content')
@include('share.status_card')

<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 6px">News</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->

<div class="news-contents wrapper">
  @include('share.article_contents')
  @include('share.sidebar')
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
