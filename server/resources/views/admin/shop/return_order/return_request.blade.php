@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">返品未対応リスト <span class="badge badge-pill badge-danger">{{ count($orders) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>受注日</th>
                                        <th>オーダー番号</th>
                                        <th>お買い上げ額</th>
                                        <th>支払い方法</th>
                                        <th>ステータス</th>
                                        <th>詳細</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                    <tr>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>¥ {{ number_format($item->amount) }}(税込)</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>
                                            @if($item->return_order == 1)
                                            <span class="badge badge-pill badge-primary">未対応</span>
                                            @elseif($item->return_order == 2)
                                            <span class="badge badge-pill badge-success">対応済</span>
                                            @endif
                                        </td>
                                        <td width="20%">
                                            <a href="{{ route('return.request.details', $item->id) }}" class="btn btn-info" title="詳細"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
