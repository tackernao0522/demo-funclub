@extends('layouts.app')

@section('title')
Information
@endsection

@section('content')
<div id="info" class="big-bg">
  @include('share.home_header')

  <div class="info-content wrapper">
    <h2 class="page-title">Info</h2>
    <p>
      体に優しい自然食を提供する、WCB CAFE。無添加の食材を利用したメニューが特徴です。
      おいしいブレンドコーヒーとヘルシーなオーガニックフードで体の内側から癒やされてください。
    </p>
  </div><!-- /.info-content -->
</div><!-- /#info -->

<div class="wrapper grid">
  <div class="item big-box">
    <img src="images/menu1.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu2.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu3.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu4.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu5.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu6.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu7.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu8.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
  <div class="item">
    <img src="images/menu9.jpg" alt="">
    <p>写真キャプション写真キャプション</p>
  </div>
</div><!-- /.grid -->

@include('share.footer')
@endsection
