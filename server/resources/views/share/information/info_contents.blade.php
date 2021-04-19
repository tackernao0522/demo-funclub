<div id="info" class="big-bg">
  @include('share.home_header')

  <div class="info-content wrapper">
    <h2 class="page-title">Info</h2>
    <!-- $header_body->body  -->
    <p>{!! nl2br(e( $header_body->body )) !!}</p>
  </div><!-- /.info-content -->
  @include('admin.share.info_header_body_drop')
</div><!-- /#info -->

<div class="wrapper grid">
  <div class="item big-box">
    <img src="/storage/big-info-images/menu1.jpg" alt="">
    <p>
      {!! nl2br(e(Str::limit($big_image->description, 16))) !!}
      <a class="card-link" href="#">続きを読む</a>
    </p>
  </div>
  @foreach($informations as $info)
  <div class="item">
    <img src="/storage/info-images/{{ $info->info_image_name }}" alt="">
    <p>
      {!! nl2br(e(Str::limit($info->description, 16))) !!}
      <a class="card-link" href="#">続きを読む</a>
    </p>
  </div>
  @endforeach
</div><!-- /.grid -->

@include('share.footer')
