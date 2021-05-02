@extends('layouts.app')

@section('title')
Info(詳細)
@endsection

@section('content')
<div id="info" class="big-bg">
  @include('share.home_header')
  @include('share.status_card')
  <div class="info-content wrapper">
    <h2 class="page-title">Info</h2>
    <!-- $header_body->body  -->
    <p>{!! nl2br(e( $header_body->info_header_body )) !!}</p>
  </div><!-- /.info-content -->
  @include('admin.share.info_header_body_drop')
</div><!-- /#info -->

<div>
  <article style="margin: 70px auto">
    @include('admin.information.small_info_modal')
    <div style="text-align: center">
      <img src="{{ Storage::disk('s3')->url("info-images/{$information->info_image_name}") }}" style="width: 90%" alt="ライブの様子等">
      <p style="width: 90%; margin: 0 auto; text-align: left">{!! nl2br(e( $information->description )) !!}</p>
    </div>
    <hr>
  </article>
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
