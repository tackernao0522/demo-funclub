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
<div class="row">
  <div class="col-8 offset-2">
    @if (session('message'))
    <div class="alert alert-{{ session('type', 'success') }}" role="alert">
      {{ session('message') }}
    </div>
    @endif
  </div>
</div>
<div class="wrapper item-detail-card">
  <div class="item item-detail" style="width: 65%; margin: 0 auto">
    <div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px; background-color: #e4dede">{{$item->name}}</div>
    <table class="table table-bordered">
      <tr>
        <th>販売元</th>
        <td>
          {{$item->seller->name}}
        </td>
      </tr>
      <tr>
        <th>カテゴリー</th>
        <td>{{$item->secondaryEcCategory->primaryEcCategory->name}} / {{$item->secondaryEcCategory->name}}</td>
      </tr>
      <tr>
        <th>商品の状態</th>
        <td>{{$item->condition->name}}</td>
      </tr>
    </table>
    <img class="card-img-top" src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}">

    <div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">
      <i class="fas fa-yen-sign"></i>
      <span>{{number_format($item->price)}}</span>
    </div>

    <div class="row">
      <div class="col-sm-12">
        @if ($item->isStateSelling)
        <a href="{{route('item.buy', [$item->id])}}" class="btn btn-secondary btn-block">購入</a>
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
