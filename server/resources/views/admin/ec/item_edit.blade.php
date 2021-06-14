@extends('layouts.article')

@section('title')
商品情報編集
@endsection

@section('content')
<div class="header-title post"><a href="{{ route('admin') }}">商品情報編集ページ</a></div>
<div class="container">
    <div class="row">
        <div class="input-form">
            <nav class="panel panel-default">
                <div class="panel-heading">商品情報の編集</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('items.edit', ['item' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- 商品画像 --}}
                        <div class="article-image">商品画像</div>
                        <span class="item-image-form image-picker">
                            <input type="file" name="item-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="item-image" />
                            <label for="item-image" class="d-inline-block" role="button">
                                @if (!empty($item->item_image_name))
                                <img class="image-form-box" src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}" style="object-fit: cover; width: 300px; height: 300px;">
                                @else
                                <img class="image-form-box" src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
                            </label>
                            @endif
                        </span>
                        {{-- 商品名 --}}
                        <div class="form-group">
                            <label class="article" for="name">商品名</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $item->name) }}" />
                        </div>
                        {{-- 商品の説明 --}}
                        <div class="form-group">
                            <label class="article" for="description">商品の説明</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description', $item->description) }}</textarea>
                        </div>
                        {{-- 在庫数 --}}
                        <div class="form-group">
                            <label class="article" for="stock">在庫数</label>
                            <input type="text" class="form-control" name="stock" id="stock" value="{{ old('stock', $item->stock) }}" placeholder="半角数字で入力してください" />
                        </div>
                        {{-- カテゴリー --}}
                        <div class="form-group">
                            <label class="article" for="ec_category">カテゴリー</label>
                            <select name="ec_category" class="form-control">
                                @foreach ($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->secondaryEcCategories as $secondary)
                                    <option value="{{ $secondary->id }}" {{ old('category', $item->secondary_ec_category_id) == $secondary->id ? 'selected' : '' }}>{{ $secondary->name }}</option>
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
                                <option value="{{$condition->id}}" {{old('condition', $item->item_condition_id) == $condition->id ? 'selected' : ''}}>{{ $condition->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 配送料の負担  --}}
                        <div class="form-group">
                            <label class="article" for="payer">配送料</label>
                            <select name="payer" class="form-control">
                                @foreach ($shippingFeePayers as $payer)
                                <option value="{{$payer->id}}" {{old('payer', $item->shipping_fee_payer_id) == $payer->id ? 'selected' : ''}}>{{ $payer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 配送方法  --}}
                        <div class="form-group">
                            <label class="article" for="delivery">配送方法</label>
                            <select name="delivery" class="form-control">
                                @foreach ($deliveryMethods as $delivery)
                                <option value="{{$delivery->id}}" {{old('delivery', $item->delivery_method_id) == $delivery->id ? 'selected' : ''}}>{{ $delivery->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 発送までの日数  --}}
                        <div class="form-group">
                            <label class="article" for="delivery_time">配送までの日数</label>
                            <select name="delivery_time" class="form-control">
                                @foreach ($deliveryTimes as $deliveryTime)
                                <option value="{{$deliveryTime->id}}" {{old('deliveryTime', $item->delivery_time_id) == $deliveryTime->id ? 'selected' : ''}}>{{ $deliveryTime->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 販売価格 --}}
                        <div calss="form-group">
                            <label class="article" for="price">販売価格(税込)</label>
                            <input type="number" class="form-control" name="price" id="price" value="{{ old('price', $item->price) }}" />
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-success">更新</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
