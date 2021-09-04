@extends('admin.admin_master')

@section('admin')
<style>
    .col-sm-12.col-md-7 {
        padding-left: 450px;
    }
</style>
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">メールマガジン会員リスト <span class="badge badge-pill badge-danger">{{ count($newsletterMembers) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>会員ID</th>
                                        <th>メールアドレス</th>
                                        <th>登録日</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($newsletterMembers as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('newsletterMember.delete', $item->id) }}" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
