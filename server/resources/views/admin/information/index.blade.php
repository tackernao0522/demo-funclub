@extends('layouts.app')

@section('title')
Information
@endsection

@section('content')
<div id="info" class="big-bg">
  @include('share.home_header')

  <div class="info-content wrapper">
    <h2 class="page-title">Info</h2>
    <!-- $header_body->body  -->
    <p>{!! nl2br(e( $header_body->body )) !!}</p>
  </div><!-- /.info-content -->
</div><!-- /#info -->

<div class="wrapper grid">
  <div class="item big-box">
    <img src="/images/menu1.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  @foreach($informations as $info)
  <div class="item">
    <img src="/storage/info-images/{{ $info->info_image_name }}" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  @endforeach
</div><!-- /.grid -->

@include('share.footer')
@endsection