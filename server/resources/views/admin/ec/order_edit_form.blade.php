@extends('layouts.article')

@section('title')
オーダーチェック
@endsection

@section('content')
{{Form::hidden('', $increment = 1)}}
<div class="header-title post"><a href="{{ route('item.orders') }}">オーダーチェック</a></div>
<div class="container">
    <div class="row">
        <div class="input-form">
            <nav class="panel panel-default">
                <div class="panel-heading">オーダーチェック</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="article" for="name">注文番号</label>
                            <div style="font-size: 1.5rem">
                                {{ $payer_id }}
                            </div>
                            <input type="hidden" class="form-control" name="payer_id" id="name" value="{{ $payer_id }}" />
                        </div>
                        <div class="form-group">
                            <label class="article" for="name">注文日</label>
                            <div style="font-size: 1.5rem">
                                {{ $date }}
                            </div>
                            <input type="hidden" class="form-control" name="date" id="name" value="{{ $date }}" />
                        </div>
                        <div class="form-group">
                            <label class="article" for="name">お名前</label>
                            <div style="font-size: 1.5rem">
                                {{ $name }} 様
                            </div>
                            <input type="hidden" class="form-control" name="name" id="name" value="{{ $name }}" />
                        </div>
                        <div class="form-group">
                            <label class="article" for="zip_code">郵便番号</label>
                            <div style="font-size: 1.5rem">
                                {{ $zip_code }}
                            </div>
                            <input type="hidden" class="form-control" name="zip_code" id="zip_code" value="{{ $zip_code }}" />
                        </div>
                        <div class="form-group">
                            <label class="article" for="address">お届け先</label>
                            <div style="font-size: 1.5rem">
                                {{ $address }}
                            </div>
                            <input type="hidden" class="form-control" name="address" id="address" value="{{ $address }}" />
                        </div>
                        <div class="form-group">
                            <label class="article" for="address">電話番号</label>
                            <div style="font-size: 1.5rem">
                                {{ $phone_number }}
                            </div>
                            <input type="hidden" class="form-control" name="phone_number" id="phone_number" value="{{ $phone_number }}" />
                        </div>
                        @if ($item_size)
                        <div class="form-group">
                            <label class="article" for="address">サイズ</label>
                            <div style="font-size: 1.5rem">
                                {{ $item_size }}
                            </div>
                            <input type="hidden" class="form-control" name="item_size" id="item_size" value="{{ $item_size }}" />
                        </div>
                        @endif
                        <div class="form-group">
                            {{-- @foreach ($orders as $order)
                            @if ($order->item_size)
                            <label class="article" for="your_message">サイズ</label>
                            <div class="mb-2" style="font-size: 1.5rem !important">
                            {{ $order->item_size }}
                            @endif
                            @endforeach
                        </div> --}}
                        <label class="article" for="your_message">商品</label>
                        @foreach ($orders as $order)
                        @foreach($order->cart->items as $item)
                        <div class="mb-2" style="font-size: 1.5rem !important">
                            {{ $increment . '：'}}
                            {{ $item['item_name'] . ' ／ ' }} {{ '  数量 ' . '[' . $item['qty'] . ']  ／' }} {{ ' 単価 ' . '[¥' . number_format($item['item_price']) . '] ／ ' }} {{ ' 小計 ' . '[¥' . number_format($item['item_price'] * $item['qty']) . ']' }}
                            <input type="hidden" name="item_name" value="{{ $item['item_name'] }}">
                            <input type="hidden" name="qty" value="{{ $item['qty'] }}">
                            <input type="hidden" name="item_price" value="{{ $item['item_price'] }}">
                            {{Form::hidden('', $increment = $increment + 1)}}
                            @endforeach
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label class="article" for="address">合計金額</label>
                            <div style="font-size: 1.5rem">
                                ¥{{ number_format($totalPrice = $order->cart->totalPrice) }}(税込)
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="article" for="status">状態</label>
                            <select name="status" class="form-control">
                                @foreach(\App\Models\Order::STATUS as $key => $val)
                                <option value="{{ $key }}" {{ $key == old('status', $order->status) ? 'selected' : '' }}>
                                    {{ $val['label'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">更新</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
