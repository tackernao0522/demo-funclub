@extends('shop.shop_master')

@section('title')
404ERROR
@endsection

@section('content')
<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">
            <div class="row">
                <div class="col-md-12 x-text text-center">
                    <h1>404</h1>
                    <p>We are sorry, the page you've requested is not available. </p>
                    <a href="{{ route('shop.index') }}"><i class="fa fa-home"></i> オンラインショップページへ</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
