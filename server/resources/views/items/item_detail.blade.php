@extends('layouts.app')

@section('title')
{{$item->name}} | 商品詳細
@endsection

@section('content')
<div id="news" class="big-bg">
  <div class="wrapper">
    <h2 class="page-title" style="padding-top: 15px">Detail</h2>
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
        @if (Auth::check() && Auth::user()->role === 'admin')
        @if ($item->isStateSelling)
        <form method="POST" action="{{ route('cart.item', [$item->id]) }}">
          @csrf
          <select name="quantity" class="form-control col-md-2 mr-1">
            <option selected>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <button type="submit" class="btn btn-primary col-md-7" style="margin: 0; max-width: 100% !important; height: 35px !important; line-height: inherit">カートに入れる</button>
        </form>
        @else
        <button class="btn btn-dark btn-block" disabled>売却済み</button>
        @endif
        @elseif (Auth::check() && Auth::user()->role === 'premium')
        @if ($item->isStateSelling)
        <form method="POST" action="{{ route('cart.item', [$item->id]) }}">
          @csrf
          <select name="quantity" class="form-control col-md-2 mr-1">
            <option selected>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
          </select>
          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <button type="submit" class="btn btn-primary col-md-7" style="max-width: 100% !important; height: 35px !important; line-height: inherit">カートに入れる</button>
        </form>
        @else
        <button class="btn btn-dark btn-block" disabled>売却済み</button>
        @endif
        @endif
      </div>
    </div>

    <div class="my-3" style="font-size: 16px">{!! nl2br(e($item->description)) !!}</div>
  </div>
</div>
@include('share.footer')
@endsection
