@extends('layouts.app')

@section('title')
Online Shop
@endsection

@section('content')
<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 15px">Online Shop</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->

<div class="col-12 offset-2 text-center status-alert" id="status-alert" style="margin: 0 auto; width: 67%">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
</div>
<div class="col-12 offset-2 text-center status-alert" id="status-alert" style="margin: 0 auto; width: 67%">
  @if (session('danger_error'))
  <div class="alert alert-danger" role="alert">
    {{ session('danger_error') }}
  </div>
  @endif
</div>

<div class="header-title items-title" style="margin-top: 5px; border-color: gold; width: 65%">Premium会員限定販売</div>

@include('items.categories_search')

<div class="wrapper grid" style="margin-top: 50px !important">
  @foreach ($items as $item)
  <div class="item items-index" style="border: 1px solid black; max-width: 254.22px; max-height: 362.22px; margin:15px auto">
    <div class="position-relative overflow-hidden" style="border-bottom: 1px solid black">
      <img class="card-img-top" src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}">
      <div class="position-absolute py-2 px-3" style="left: 0; bottom: 20px; color: white; background-color: rgba(0, 0, 0, 0.70)">
        <i class="fas fa-yen-sign"></i>
        <span class="ml-1">{{number_format($item->price)}}(税込)</span>
      </div>
      @if ($item->isStateBought)
      <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 125px; height: 125px; font-size: 20px;">
        <span>SOLD</span>
      </div>
      @endif
    </div>
    <a href="{{ route('item', [$item->id]) }}">
      <h6 style="margin-left: 19px; padding-top: 5px; color: fuchsia">在庫数：{{ $item->stock }}</h6>
      <div class="card-body">
        <small class="text-muted" style="margin: -10px 0 0 -10px">{{$item->secondaryEcCategory->primaryEcCategory->name}} / {{$item->secondaryEcCategory->name}}</small>
        <h5 class="card-title item-name" style="padding-top: 15px">{!! nl2br(e(Str::limit($item->name, 16))) !!}</h5>
      </div>
    </a>
    @include('items.cart_items.cart_form')
  </div>
  @endforeach
</div>
<div class="d-flex justify-content-center">
  {{ $items->appends(Request::only('keyword', 'category'))->links('vendor.pagination.original') }}
</div>

@include('share.footer')
@endsection
