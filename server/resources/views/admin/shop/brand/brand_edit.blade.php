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
                        <h3 class="box-title">ブランド編集</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>ブランド名 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_name" class="form-control" value="{{ old('brand_name', $brand->brand_name) }}">
                                        @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>ブランド画像 <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="brand_image" class="form-control">
                                        @error('brand_image')
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
