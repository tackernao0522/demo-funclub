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
                        <h3 class="box-title">会員登録数 <span class="badge badge-pill badge-danger">{{ count($users) }}人</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>プロフィール画像</th>
                                        <th>名前</th>
                                        <th>メールアドレス</th>
                                        <th>電話番号</th>
                                        <th>ステータス</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        @if ( $user->role === 'admin' )
                                        <td><img src="{{ (!empty($user->profile_photo_path)) ? Storage::disk('s3')->url("admin-profile/{$user->profile_photo_path}") : url('upload/no_image.jpg') }}" style="height:50px; width:50px"></td>
                                        @else
                                        <td><img src="{{ (!empty($user->profile_photo_path)) ? Storage::disk('s3')->url("user-profile/{$user->profile_photo_path}") : url('upload/no_image.jpg') }}" style="height:50px; width:50px"></td>
                                        @endif
                                        <td>{{ $user->name }} 様</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @if($user->userOnline())
                                            <span class="badge badge-pill badge-success">ログイン中</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <a href="" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a> -->
                                            @if ($user->type === 1)
                                            @else
                                            <a href="{{ route('allUser.delete', $user->id) }}" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                            @endif
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
