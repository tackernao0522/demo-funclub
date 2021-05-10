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

@include('share.status_card')

<div class="wrapper grid" style="margin-top: 100px !important;">
  @foreach ($items as $item)
  <a href="{{ route('item', [$item->id]) }}">
  <div class="item" style="border: 1px solid black; max-width: 254.22px; max-height: 362.22px; margin: 0 auto">
    <div class="position-relative overflow-hidden" style="border-bottom: 1px solid black">
      <img class="card-img-top" src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}">
      <div class="position-absolute py-2 px-3" style="left: 0; bottom: 20px; color: white; background-color: rgba(0, 0, 0, 0.70)">
        <i class="fas fa-yen-sign"></i>
        <span class="ml-1">{{number_format($item->price)}}</span>
      </div>
      @if ($item->isStateBought)
      <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 125px; height: 125px; font-size: 20px;">
        <span>SOLD</span>
      </div>
      @endif
    </div>
    <div class="card-body">
      <small class="text-muted">{{$item->secondaryEcCategory->primaryEcCategory->name}} / {{$item->secondaryEcCategory->name}}</small>
      <h5 class="card-title item-name" style="padding-top: 15px">{{$item->name}}</h5>
    </div>
  </div>
  </a>
  @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $items->links('vendor.pagination.original') }}
</div>

@include('share.footer')
@endsection
