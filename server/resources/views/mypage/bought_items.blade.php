@extends('layouts.app')

@section('title')
購入した商品一覧
@endsection

@section('content')
<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 15px">My Page</h2>
  </div><!-- /.wrapper -->
</div><!-- /#news -->
<div class="container">
  <div style="margin-top: 10px">
  </div>
  <div class="row">
    <div class="col-12 offset-1 bg-white mt-3 mb-3" style="margin: 0 auto">

      <div class="font-weight-bold text-center border-bottom pb-3 pt-3 mb-3" style="font-size: 24px">購入した商品</div>

      @forelse ($items as $item)
      <div class="item" style="margin-bottom: 20px">
        <img src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}" class="img-fluid" style="height: 140px;">
        <div class="d-flex mt-3 border position-relative">
          <div>
          </div>
          <div class="flex-fill p-3">
            <div>
              <span class="badge badge-dark px-2 py-2">売却済</span>
              <span>{{$item->secondaryEcCategory->primaryEcCategory->name}} / {{$item->secondaryEcCategory->name}}</span>
            </div>
            <div class="card-title mt-2 font-weight-bold" style="font-size: 20px">{{$item->name}}</div>
            <div>
              <i class="fas fa-yen-sign"></i>
              <span class="ml-1">{{number_format($item->price)}}</span>
              <i class="far fa-clock ml-3"></i>
              <span>{{$item->created_at->format('Y年n月j日 H:i')}}</span>
            </div>
          </div>
          <a href="{{ route('item', [$item->id]) }}" class="stretched-link"></a>
        </div>

      </div>
      @empty
      <div class="text-center pb-3" style="color: deeppink">購入した商品はありません。</div>
      @endforelse
    </div>
  </div>
</div>
<div class="d-flex justify-content-center">
  {{ $items->links('vendor.pagination.original') }}
</div>
@include('share.footer')
@endsection
