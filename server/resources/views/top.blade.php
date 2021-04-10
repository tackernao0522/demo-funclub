@extends('layouts.app')

@section('title')
  Top
@endsection

@section('content')
<div id="home" class="big-bg">
  @include('share.home_header')
</div><!-- /#home -->

<div class="home-content wrapper">
  <h2 class="page-title">We'll Make Your Day</h2>
  <p>楽しいひと時をみんなと満喫してみませんか？</p>
  <a class="button" href="#">メニューを見る</a>
</div><!-- /.home-content -->
@endsection
