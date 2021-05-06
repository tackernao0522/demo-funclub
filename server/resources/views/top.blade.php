@extends('layouts.app')

@section('title')
Top
@endsection

@section('content')
<div id="home" class="big-bg">
  @include('share.status_card')
  <div class="home-content wrapper">
    <!-- Dropdown -->
    @if ( Auth::check() && Auth::user()->role === 'admin' )
    <div class="ml-auto card-text text-center">
      <div class="dropdown mt-2 pb-3">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-light text-muted m-0 p-2" style="width: 200px">
            <i class="fas fa-caret-down" style="color: blue"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="margin-top: 25px; width: 200px; text-align:center">
          <a class="dropdown-item" href="{{ route('top.edit_form')}}">
            <i class="fas fa-pen mr-1"></i>編集する
          </a>
        </div>
      </div>
    </div>
    <!-- Dropdown -->
    @endif
    <h2 class="page-title">{{ $top->main_title }}</h2>
    <p>{!! nl2br(e( $top->content )) !!}</p>
    @if ( Auth::check() && Auth::user()->role === 'admin')
    <div style="margin-bottom: 70px">
      <a class="button" href="{{ route('informations.index') }}">INFORMATION</a>
    </div>
    @else
    <a class="button" href="{{ route('informations.index') }}">INFORMATION</a>
    @endif
  </div><!-- /.home-content -->
</div><!-- /#home -->

<section id="location">

  <div class="wrapper">
    <div class="location-info">
      <h3 class="sub-title">西川口 ハーツ</h3>
      <p>
        住所： 東京都〇〇区<br>
        〇〇〇〇〇〇〇 000-22-1<br>
        〇〇〇〇<br>
        電話： 03-1111-1111<br>
        営業時間： 10:00〜20:00<br>
        休日：水曜
      </p>
    </div><!-- /.location-info -->
    <div class="location-map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.4466958110115!2d139.73464221478676!3d35.66600153841542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188b835942e165%3A0xb4897f1f4264c771!2z44CSMTA2LTAwMzIg5p2x5Lqs6YO95riv5Yy65YWt5pys5pyo77yS5LiB55uu77yU4oiS77yV!5e0!3m2!1sja!2sjp!4v1543466837094" width="800" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div><!-- /.location-map -->
  </div><!-- /.wrapper -->
</section><!-- /#location -->

<section id="sns">
  <div class="wrapper">
    <div class="sns-box">
      <h3 class="sub-title">Facebook</h3>
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fwebcreatorbox.fb%2F&tabs=timeline&width=340&height=315&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=229812980409867" width="340" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>

    <div class="sns-box">
      <h3 class="sub-title">Twitter</h3>
      <a class="twitter-timeline" data-height="315" href="https://twitter.com/webcreatorbox?ref_src=twsrc%5Etfw">Tweets by webcreatorbox</a>
      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>

    <div class="sns-box">
      <h3 class="sub-title">Youtube</h3>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/bqJtUojA1-g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div><!-- /.wrapper -->
</section><!-- /#sns -->
@include('share.footer')
@endsection
