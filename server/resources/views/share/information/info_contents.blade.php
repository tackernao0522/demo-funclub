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


<div class="d-flex justify-content-center mt-5 pt-1" style="margin-bottom: -100px">
  @if ( Auth::check() && Auth::user()->role === 'admin' )
  <div class="mr-2" style="margin-top: -7px">
    <button class="btn btn-primary" type="button" onclick="history.back()">Back</button>
  </div>
  @else
  <div class="mr-2">
    <button class="btn btn-primary" type="button" onclick="history.back()">Back</button>
  </div>
  @endif
  {{ $informations->links('vendor.pagination.original') }}
</div>
<div class="wrapper grid" style="margin-top: 100px !important">
  <div class="item big-box">
    <img src="/storage/big-info-images/{{ $big_image->info_big_image_name }}" alt="">
    <p>
      @if ( Auth::check() && Auth::user()->role === 'admin' )
      {!! nl2br(e(Str::limit($big_image->description, 16))) !!}
      <a class="card-link" href="{{ route('bigInfo.show') }}">続きを読む</a>
      @include('admin.share.information.big_image_drop')
      @elseif ( Auth::check() && Auth::user()->role === 'premium' )
      {!! nl2br(e(Str::limit($big_image->description, 16))) !!}
      <a class="card-link" href="{{ route('bigInfo.show') }}">続きを読む</a>
      @else
      {!! nl2br(e(Str::limit($big_image->description, 11))) !!}
      <a class="card-link" href="{{ route('bigInfo.show') }}">続きは有料会員限定</a>
      @endif
    </p>
  </div>
  @foreach($informations as $info)
  <div class="item">
    <img src="/storage/info-images/{{ $info->info_image_name }}" alt="">
    <p>
      @if ( Auth::check() && Auth::user()->role === 'admin' )
      {!! nl2br(e(Str::limit($info->description, 16))) !!}
      <a class="card-link" href="{{ route('information.show', [$info->id]) }}">続きを読む</a>
      @include('admin.share.information.info_image_drop')
      @elseif ( Auth::check() && Auth::user()->role === 'premium' )
      {!! nl2br(e(Str::limit($info->description, 16))) !!}
      <a class="card-link" href="{{ route('information.show', [$info->id]) }}">続きを読む</a>
      @else
      {!! nl2br(e(Str::limit($info->description, 16))) !!}
      <a class="card-link" href="{{ route('information.show', [$info->id]) }}">続きは有料会員限定</a>
      @endif
    </p>
  </div>
  @endforeach
</div><!-- /.grid -->

@include('share.footer')
