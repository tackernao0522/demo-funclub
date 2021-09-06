@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">返品承認済リスト</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">返品承認済リスト</li>
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
                        <h4 class="box-title"><strong>返品承認済詳細</strong> <span class="badge badge-pill badge-danger">{{ count($orders) }}</span></h4>
                    </div>
                    @foreach($orders as $key => $item)
                    <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                        <tr>
                            <th>ID : </th>
                            <th>{{ $key + 1 }}</th>
                        </tr>

                        <tr>
                            <th>受注日 : </th>
                            <th>{{ $item->order_date }}</th>
                        </tr>

                        <tr>
                            <th>返品オーダー番号 : </th>
                            <th>{{ $item->invoice_no }}</th>
                        </tr>

                        <tr>
                            <th>返品商品番号 : </th>
                            <th>{{ $item->return_product_no }}</th>
                        </tr>

                        <tr>
                            <th>返品商品名 : </th>
                            <th>{{ $item->return_product_name }}</th>
                        </tr>

                        <tr>
                            <th>返品理由 : </th>
                            <th>{!! nl2br(e( $item->return_reason )) !!}</th>
                        </tr>

                        <tr>
                            <th style="border: solid 1px blue">支払い済価格 : </th>
                            <th>¥ {{ number_format($item->amount) }}(税込)</th>
                        </tr>

                        <tr>
                            <th>支払い方法 : </th>
                            <th>{{ $item->payment_method }}</th>
                        </tr>

                        @if($item->return_order_method_name_id === 1)
                        <tr>
                            <th style="border: solid 1px red">返金額 : </th>
                            <th><span class="badge badge-pill badge-success">¥ {{ number_format($item->refund_amount) }}(税込)</span></th>
                        </tr>
                        @endif

                        @if($item->return_order_method_name_id === 2)
                        <tr>
                            <th>対応方法 : </th>
                            <th><span class="badge badge-pill badge-success">商品交換</span></th>
                        </tr>
                        @endif

                        <tr>
                            <th>ステータス : </th>
                            @if($item->return_order == 1)
                            <th><span class="badge badge-pill badge-primary">未対応</span></th>
                            @elseif($item->return_order == 2)
                            <th><span class="badge badge-pill badge-success">承認済</span><span class="badge badge-warning ml-3">返品対応完了</span></th>
                            @endif
                        </tr>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
