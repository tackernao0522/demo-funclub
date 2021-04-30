@extends('layouts.app')

@section('title')
Info(詳細)
@endsection

@section('content')
<div id="info" class="big-bg">
  @include('share.home_header')
  <div class="row article-post">
    <div class="col-8 offset-2">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </div>
  <div class="info-content wrapper">
    <h2 class="page-title">Info</h2>
    <!-- $header_body->body  -->
    <p>{!! nl2br(e( $header_body->info_header_body )) !!}</p>
  </div><!-- /.info-content -->
  @include('admin.share.info_header_body_drop')
</div><!-- /#info -->

<div>
  <article style="margin: 70px auto">
    <!-- Dropdown -->
    @if ( Auth::check() && Auth::user()->role === 'admin' )
    <div class="ml-auto card-text text-center">
      <div class="dropdown pb-1 mt-4">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-primary text-muted m-0 p-2" style="width: 200px">
            <i class="fas fa-caret-down" style="color: white"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right text-center" style="margin-top: 25px; width: 200px">
          <a class="dropdown-item" href="{{ route('big_image.edit') }}">
            <i class="fas fa-pen mr-1"></i>編集する
          </a>
        </div>
      </div>
    </div>
    <!-- Dropdown -->
    @endif
    <div style="text-align: center">
      {{-- <img src="/storage/big-info-images/{{ $big_image->info_big_image_name }}" style="width: 90%" alt="ライブの様子等"> --}}
      <img src="{{ Storage::disk('s3')->url("big-info-images/{$big_image->info_big_image_name}") }}" style="width: 90%" alt="ライブの様子等">
      <p style="width: 90%; margin: 0 auto; text-align: left">{!! nl2br(e( $big_image->description )) !!}</p>
    </div>
    <hr>
  </article>
</div><!-- /.news-contents -->

@include('share.footer')
@endsection
