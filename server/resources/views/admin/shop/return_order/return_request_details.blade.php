@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">返品未対応詳細</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">返品未対応詳細</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>返品未対応詳細</strong></h4>
                    </div>
                    <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <tr>
                            <th>お名前 : </th>
                            <th>{{ $order->name }} 様</th>
                        </tr>

                        <tr>
                            <th>受注日 : </th>
                            <th>{{ $order->order_date }}</th>
                        </tr>

                        <tr>
                            <th>返品オーダー番号 : </th>
                            <th>{{ $order->invoice_no }}</th>
                        </tr>

                        <tr>
                            <th>返品商品番号 : </th>
                            <th>{{ $order->return_product_no }}</th>
                        </tr>

                        <tr>
                            <th>返品商品名 : </th>
                            <th>{{ $order->return_product_name }}</th>
                        </tr>

                        <tr>
                            <th>返品理由 : </th>
                            <th>{!! nl2br(e( $order->return_reason )) !!}</th>
                        </tr>

                        <tr>
                            <th style="border: solid 1px blue">支払い済価格 : </th>
                            <th>¥ {{ number_format($order->amount) }}(税込)</th>
                        </tr>

                        <tr>
                            <th>支払い方法 : </th>
                            <th>{{ $order->payment_method }}</th>
                        </tr>

                        <tr>
                            <th>ステータス : </th>
                            @if($order->return_order == 1)
                            <th><span class="badge badge-pill badge-primary">未対応</span></th>
                            @elseif($order->return_order == 2)
                            <th><span class="badge badge-pill badge-success">対応済</span></th>
                            @endif
                        </tr>

                        @if($order->return_order_method_name_id === NULL)
                        <form action="{{ route('return-method', $order->id) }}" method="POST">
                            @csrf
                            <tr>
                                <th>対応方法 : </th>
                                <th>
                                    <div class="controles">
                                        <select name="return_order_method_name_id" class="form-control" style="color: red">
                                            <option value="" selected="" disabled="">--対応方法選択--</option>
                                            @foreach($returnOrderProductMethods as $returnOrderMethod)
                                            <option value="{{ $returnOrderMethod->id }}" {{ old('return_order_method_name_id') == $returnOrderMethod->id ? 'selected': '' }}>{{ $returnOrderMethod-> return_order_method_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('return_order_method_name_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-xs-right mt-3">
                                        <input type="submit" class="btn btn-rounded btn-danger mb-5" value="決定">
                                    </div>
                                </th>
                            </tr>
                        </form>
                        @endif

                        @if($order->return_order_method_name_id === 1 && $order->refund_amount === NULL)
                        <tr>
                            <th>返金額入力 : </th>
                            <th>
                                <form action="{{ route('refund.amount', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="text" name="refund_amount" class="form-control" value="{{ old('refund_amount') }}">
                                    @error('refund_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="text-xs-right mt-3">
                                        <input type="submit" class="btn btn-rounded btn-danger mb-5" value="決定">
                                    </div>
                                </form>
                            </th>
                        </tr>
                        @endif

                        @if($order->refund_amount === NULL)
                        @else
                        <tr>
                            <th>返金額 : </th>
                            <th><span class="badge badge-pill badge-success">¥ {{ number_format($order->refund_amount) }}(税込)</span></th>
                        </tr>
                        @endif

                        @if($order->return_order_method_name_id === 2)
                        <tr>
                            <th>対応方法 : </th>
                            <th><span class="badge badge-pill badge-success">商品交換</span></th>
                        </tr>
                        @endif

                        @if($order->return_order_method_name_id === 1 && $order->refund_amount === NULL)
                        <tr>
                            <th>承認の可否 : </th>
                            <th><span class="text-danger">返金額を決定してください</span></th>
                        </tr>
                        @elseif($order->return_order_method_name_id === NULL && $order->refund_amount === NULL)
                        <tr>
                            <th>承認の可否 : </th>
                            <th><span class="text-danger">対応方法を決定をしてください</span></th>
                        </tr>
                        @else
                        <tr>
                            <th>承認の可否 : </th>
                            <th><a href="{{ route('return.approve', $order->id) }}" class="btn btn-danger">承認する</a></th>
                        </tr>
                        @endif

                        @php
                        $count = 1;
                        $orderItems = App\Models\OrderItem::with('product')->where('order_id', $order->id)
                        ->orderBy('id', 'DESC')
                        ->get();
                        @endphp
                        @foreach($orderItems as $item)
                        <tr>
                            <th style="border: solid 1px red">オーダー商品画像{{ $count++ }} : </th>
                            <th><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product->product_thambnail}") }}" height="50px" width="50px"></th>
                        </tr>
                        <tr>
                            <th>オーダー商品名 : </th>
                            <th>{{ $item->product->product_name }}</th>
                        </tr>
                        <tr>
                            <th>オーダー商品番号 : </th>
                            <th>{{ $item->product->product_code }}</th>
                        </tr>
                        <tr>
                            <th>オーダーカラー : </th>
                            <th>{{ $item->color }}</th>
                        </tr>
                        <tr>
                            <th>オーダーサイズ : </th>
                            <th>{{ $item->size }}</th>
                        </tr>
                        <tr>
                            <th>数量 : </th>
                            <th>{{ $item->qty }}</th>
                        </tr>
                        <tr>
                            <th>商品価格 : </th>
                            <th>¥ {{ number_format($item->price) }} (¥{{ number_format($item->price * $item->qty) }})(税込)</th>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
