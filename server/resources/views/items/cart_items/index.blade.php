@extends('layouts.app')

@section('title')
カートの中身
@endsection

@section('content')
<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 15px">Cart</h2>
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
<div class="header-title items-title" style="margin-top: 5px; border-color: gold; width: 65%""><a style=" color: black" href="{{route('items.index')}}">ショッピングカート</a></div>
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        @forelse ($cartitems as $cartitem)
        <div class="card-header bg-dark cart_item_name">
          <a class="cart_items_index" href="{{ route('item', [$cartitem->item_id]) }}">{{ $cartitem->name }}</a>
        </div>
        <div class="card-body">
          <div>
            <img src="{{ Storage::disk('s3')->url("item-images/{$cartitem->item_image_name}") }}" style="width: 20%; margin-top: -10px">
          </div>
          <div>
            {{$cartitem->secondaryEcCategory->primaryEcCategory->name}} / {{$cartitem->secondaryEcCategory->name}}
          </div>
          <div>
            {{ $cartitem->condition->name }}
          </div>
          <div>
            {{ $cartitem->payer->name }}
          </div>
          <div>
            {{ $cartitem->price }}円(税込)
          </div>
          @if (Auth::check() && Auth::user()->role === 'admin')
          <div class="form-inline">
            <!-- 数量を更新するフォームに変更 -->
            <form method="POST" action="/cartitem/{{ $cartitem->id }}" style="display: inline-flex">
              @method('PUT')
              @csrf
              <input type="text" class="form-control cart-edit-form" name="quantity" value="{{ $cartitem->quantity }}">
              <div style="display: inline; margin: 7px 3px 0 3px">点</div>
              <button type="submit" class="btn btn-success" style="height: 40px; line-height: inherit; margin: 0">更新</button>
            </form>
            <!-- 削除フォームを追加 -->
            <form method="POST" action="/cartitem/{{ $cartitem->id }}">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger ml-1 cart-item-delete" style="height: 40px; line-height: inherit">カートから削除する</button>
            </form>
          </div>
          @elseif (Auth::check() && Auth::user()->role === 'premium')
          <div class="form-inline">
            <!-- 数量を更新するフォームに変更 -->
            <form method="POST" action="/cartitem/{{ $cartitem->id }}" style="display: inline-flex">
              @method('PUT')
              @csrf
              <input type="text" class="form-control cart-edit-form" name="quantity" value="{{ $cartitem->quantity }}">
              <div style="display: inline; margin: 7px 3px 0 3px">点</div>
              <button type="submit" class="btn btn-success" style="height: 40px; line-height: inherit">更新</button>
            </form>
            <!-- 削除フォームを追加 -->
            <form method="POST" action="/cartitem/{{ $cartitem->id }}">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger ml-1 cart-item-delete" style="height: 40px; line-height: inherit">カートから削除する</button>
            </form>
          </div>
          @endif
        </div>
        @empty
        <div class="text-center pb-3" style="color: deeppink; padding-top: 15px">カートに商品はありません。</div>
        @endforelse
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-dark" style="color: cornsilk">
          小計
        </div>
        <div class="card-body">
          {{ $subtotal }}円(税込)
        </div>
      </div>
    </div>
  </div>
</div>
@include('share.footer')
@endsection
