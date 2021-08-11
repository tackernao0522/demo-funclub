@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Add Brand Page -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">カテゴリー編集</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('category.update', $category->id) }}">
                                @csrf
                                <div class="form-group">
                                    <h5>カテゴリー名 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}">
                                        @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>カテゴリーアイコン <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_icon" class="form-control" value="{{ old('category_icon', $category->category_icon) }}">
                                        @error('category_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-3">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="更新">
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
