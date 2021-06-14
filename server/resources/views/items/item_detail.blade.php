@extends('layouts.app')

@section('title')
{{$item->name}} | 商品詳細
@endsection

@section('content')
<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 15px">Online Shop</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->

<!-- <div class="container"> -->
<div class="col-12 offset-2 text-center status-alert" id="status-alert" style="margin: 0 auto; width: 67%">
  @if (session('message'))
  <div class="alert alert-{{ session('type', 'success') }}" role="alert">
    {{ session('message') }}
  </div>
  @endif
</div>
<div class="wrapper item-detail-card">
  <div class="item item-detail" style="width: 65%; margin: 0 auto">

    @include('items.item_detail_panel')

    <div class="row">
      <div class="col-sm-12">
        @if ($item->isStateSelling)
        <a href="{{route('item.buy', [$item->id])}}" class="btn btn-primary btn-block">購入</a>
        @else
        <button class="btn btn-dark btn-block" disabled>売却済み</button>
        @endif
      </div>
    </div>

    <div class="my-3" style="font-size: 16px">{!! nl2br(e($item->description)) !!}</div>
  </div>
</div>
@include('share.footer')
@endsection
