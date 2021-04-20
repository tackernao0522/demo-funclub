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


<div class="wrapper grid">
  <div class="item big-box">
    <img src="/storage/info-images/{{ $big_image->info_big_image_name }}" alt="">
    <p>
      @if ( Auth::check() && Auth::user()->role === 'admin' )
      {!! nl2br(e(Str::limit($big_image->description, 16))) !!}
      <a class="card-link" href="#">続きを読む</a>
      @include('admin.share.information.big_image_drop')
      @else
      {!! nl2br(e(Str::limit($big_image->description, 11))) !!}
      <a class="card-link" href="#">続きを読む(会員限定)</a>
      @endif
    </p>
  </div>
  @foreach($informations as $info)
  <div class="item">
    <img src="/storage/info-images/{{ $info->info_image_name }}" alt="">
    <p>
      @if ( Auth::check() && Auth::user()->role === 'admin' )
      {!! nl2br(e(Str::limit($info->description, 16))) !!}
      <a class="card-link" href="#">続きを読む</a>
      @include('admin.share.information.info_image_drop')
      @else
      {!! nl2br(e(Str::limit($big_image->description, 16))) !!}
      <a class="card-link" href="#">続きを読む(会員限定)</a>
      @endif
    </p>
  </div>
  @endforeach
</div><!-- /.grid -->

@include('share.footer')
