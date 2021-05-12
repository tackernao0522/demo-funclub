@extends('layouts.app')

@section('title')
販売した商品一覧
@endsection

@section('content')
<div class="container">
  @include('share.status_card')
  @include('items.categories_search')
  <div class="row">
    <div class="col-10 offset-1 bg-white mt-5">

      <div class="font-weight-bold text-center border-bottom pb-3 pt-3 mb-3" style="font-size: 24px">販売した商品</div>

      @foreach ($items as $item)
      <div class="item" style="margin-bottom: 20px">
        <img src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}" class="img-fluid" style="height: 140px;">
        <div class="d-flex mt-3 border position-relative">
          <div>
          </div>
          <div class="flex-fill p-3">
            <div>
              @if ($item->isStateSelling)
              <span class="badge badge-success px-2 py-2">販売中</span>
              @else
              <span class="badge badge-dark px-2 py-2">売切れ</span>
              @endif
              <span>{{$item->secondaryEcCategory->primaryEcCategory->name}} / {{$item->secondaryEcCategory->name}}</span>
            </div>
            <div class="card-title mt-2 font-weight-bold" style="font-size: 20px">{{$item->name}}</div>
            <div class="card-title mt-2 font-weight-bold" style="font-size: 15px">残在庫数：{{$item->stock}}</div>
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
      @endforeach
    </div>
  </div>
</div>
<div class="d-flex justify-content-center">
  {{ $items->appends(Request::only('keyword', 'category'))->links('vendor.pagination.original') }}
</div>
@endsection
