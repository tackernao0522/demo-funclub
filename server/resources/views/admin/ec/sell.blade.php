@extends('layouts.article')

@section('title')
商品出品
@endsection

@section('content')
<div class="header-title post"><a href="{{ route('admin') }}">商品出品ページ</a></div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">商品の出品</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('sell') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- 商品画像 --}}
            <div class="article-image">商品画像</div>
            <span class="item-image-form image-picker">
              <input type="file" name="item-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="item-image" />
              <label for="item-image" class="d-inline-block" role="button">
                <img class="image-form-box" src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
              </label>
            </span>
            {{-- 商品名 --}}
            <div class="form-group">
              <label class="article" for="name">商品名</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
            </div>
            {{-- 商品の説明 --}}
            <div class="form-group">
              <label class="article" for="description">商品の説明</label>
              <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
            </div>
            {{-- 在庫数 --}}
            <div class="form-group">
              <label class="article" for="stock">在庫数</label>
              <input type="text" class="form-control" name="stock" id="stock" value="{{ old('stock') }}" pladeholder="半角数字で入力してください" />
            </div>
            {{-- カテゴリー --}}
            <div class="form-group">
              <label class="article" for="ec_category">カテゴリー</label>
              <select name="ec_category" class="form-control">
                @foreach ($categories as $category)
                <optgroup label="{{ $category->name }}">
                  @foreach($category->secondaryEcCategories as $secondary)
                  <option value="{{ $secondary->id }}" {{ old('category') == $secondary->id ? 'selected' : '' }}>{{ $secondary->name }}</option>
                  @endforeach
                </optgroup>
                @endforeach
              </select>
            </div>
            {{-- 商品の状態  --}}
            <div class="form-group">
              <label class="article" for="condition">商品の状態</label>
              <select name="condition" class="form-control">
                @foreach ($conditions as $condition)
                <option value="{{$condition->id}}" {{old('condition') == $condition->id ? 'selected' : ''}}>{{ $condition->name }}</option>
                @endforeach
              </select>
            </div>
            {{-- 配送料の負担  --}}
            <div class="form-group">
              <label class="article" for="payer">配送料</label>
              <select name="payer" class="form-control">
                @foreach ($shippingFeePayers as $payer)
                <option value="{{$payer->id}}" {{old('payer') == $payer->id ? 'selected' : ''}}>{{ $payer->name }}</option>
                @endforeach
              </select>
            </div>
            {{-- 配送方法  --}}
            <div class="form-group">
              <label class="article" for="delivery">配送方法</label>
              <select name="delivery" class="form-control">
                @foreach ($deliveryMethods as $delivery)
                <option value="{{$delivery->id}}" {{old('delivery') == $delivery->id ? 'selected' : ''}}>{{ $delivery->name }}</option>
                @endforeach
              </select>
            </div>
            {{-- 発送までの日数  --}}
            <div class="form-group">
              <label class="article" for="delivery_time">配送方法</label>
              <select name="delivery_time" class="form-control">
                @foreach ($deliveryTimes as $deliveryTime)
                <option value="{{$deliveryTime->id}}" {{old('deliveryTime') == $deliveryTime->id ? 'selected' : ''}}>{{ $deliveryTime->name }}</option>
                @endforeach
              </select>
            </div>
            {{-- 販売価格 --}}
            <div calss="form-group">
              <label class="article" for="price">販売価格</label>
              <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" />
            </div>
            <div class="text-right mt-3">
              <button type="submit" class="btn btn-primary">出品</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection