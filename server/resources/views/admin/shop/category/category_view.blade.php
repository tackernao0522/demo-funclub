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
                        <h3 class="box-title">カテゴリーリスト <span class="badge badge-pill badge-danger">{{ count($categories) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>カテゴリーアイコン</th>
                                        <th>カテゴリー名</th>
                                        <th>編集／削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $item)
                                    <tr>
                                        <td><span><i class="{{ $item->category_icon }}"></i></span></td>
                                        <td>{{ $item->category_name }}</td>
                                        <td width="30%">
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="{{-- route('category.delete', $item->id) --}}" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

            <!-- Add Categoy Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">カテゴリー作成</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('categoy.store') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>カテゴリー名 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}">
                                        @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>カテゴリーアイコン <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_icon" class="form-control" value="{{ old('category_icon') }}">
                                        @error('category_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="作成">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
