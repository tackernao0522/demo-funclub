@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">商品の更新 </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('product-update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <!-- start 1st row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>ブランド <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" style="color: red">
                                                        <option value="" selected="" disabled="">--ブランド選択--</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected': '' }}>{{ $brand->brand_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>メインカテゴリー <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" style="color: red">
                                                        <option value="" selected="" disabled="">--メインカテゴリー選択--</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected': '' }}>{{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>サブカテゴリー <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subCategory_id" class="form-control" style="color: red">
                                                        <option value="" selected="" disabled="">--サブカテゴリー選択--</option>
                                                        @foreach($subCategories as $subCategory)
                                                        <option value="{{ $subCategory->id }}" {{ old('subCategory_id', $product->subCategory_id) == $subCategory->id ? 'selected': '' }}>{{ $subCategory->subCategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subCategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 1st row  -->

                                    <div class="row">
                                        <!-- start 2nd row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>孫カテゴリー <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subSubCategory_id" class="form-control" style="color: red">
                                                        <option value="" selected="" disabled="">--孫カテゴリー選択--</option>
                                                        @foreach($subSubCategories as $subSubCategory)
                                                        <option value="{{ $subSubCategory->id }}" {{ old('subSubCategory_id', $product->subSubCategory_id) == $subSubCategory->id ? 'selected': '' }}>{{ $subSubCategory->subSubCategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subSubCategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品名<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required="">
                                                    @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品コード <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" value="{{ old('product_code', $product->product_code) }}" required="">
                                                    @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 2nd row  -->

                                    <div class="row">
                                        <!-- start 3RD row  -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>在庫数 <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control" value="{{ old('product_qty', $product->product_qty) }}" required="">
                                                    @error('product_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品タグ <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_name" class="form-control" value="{{ old('product_tags_name', $product->product_tags_name) }}" data-role="tagsinput">
                                                </div>
                                                @error('product_tags_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>サイズ <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size" class="form-control" value="{{ old('product_size', $product->product_size) }}" data-role="tagsinput">
                                                    @error('product_size')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 3RD row  -->

                                    <div class="row">
                                        <!-- start 5th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>カラー <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color" class="form-control" value="{{ old('product_color', $product->product_color) }}" data-role="tagsinput">
                                                    @error('product_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>価格(税込) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" value="{{ old('selling_price', $product->selling_price) }}" required="">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>割引価格(税込) <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 5th row  -->

                                    <div class="row">
                                        <!-- start 6th row  -->

                                    </div> <!-- end 6th row  -->

                                    <div class="row">
                                        <!-- start 7th row  -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>商品説明(小見出し) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp" id="textarea" class="form-control" placeholder="Textarea text">{!! nl2br(e( old('short_descp', $product->short_descp) )) !!}</textarea>
                                                </div>
                                                @error('short_descp')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 7th row  -->

                                    <div class="row">
                                        <!-- start 8th row  -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>商品説明(メイン) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_descp" rows="10" cols="80">{!! nl2br(e( old('long_descp', $product->long_descp) )) !!}</textarea>
                                                    @error('long_descp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 8th row  -->

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ old('hot_deals', $product->hot_deals) == 1 ? 'checked' : ''}}>
                                                        <label for="checkbox_2">お得情報</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ old('featured', $product->featured) == 1 ? 'checked' : ''}}>
                                                        <label for="checkbox_3">おすすめ商品</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ old('special_offer', $product->special_offer) == 1 ? 'checked' : ''}}>
                                                        <label for="checkbox_4">特別セール</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ old('special_deals', $product->special_deals) == 1 ? 'checked' : ''}}>
                                                        <label for="checkbox_5">特別割引</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="button" class="btn btn-rounded btn-primary mb-5" onclick="submit();" value="更新">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

    <!-- Start Multiple Image Update Area -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">マルチ画像 <strong>更新</strong></h4>
                    </div>
                    <form method="POST" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm mt-3 ml-3 mr-3">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('product.multiImg.delete', $img->id) }}" class="btn btn-sm btn-danger" title="削除(Delete Data)" id="delete"><i class="fa fa-trash"></i> </a>
                                        </h5>
                                        <div class="form-group">
                                            <label class="form-control-label">画像更新 <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="file" name="multi_img[{{$img->id}}]" accept="image/png,image/jpeg,image/gif">
                                        </div>
                                    </div>
                                </div>
                            </div><!--  end col md 3 -->
                            @endforeach
                        </div>
                        <div class="text-xs-right" style="margin-left: 40px">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="画像更新">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div> <!-- // end row  -->
    </section> <!-- End Multiple Image Update Area -->

    <!-- Start Thambnaile Image Update Area -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">サムネイル画像 <strong>更新</strong></h4>
                    </div>
                    <form method="POST" action="{{ route('update-product-thambnail', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm mt-3 ml-3 mr-3">
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" class="card-img-top">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-control-label">サムネイル更新 <span class="tx-danger">*</span></label>
                                            <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)">
                                            <img src="" id="mainThmb" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div><!--  end col md 3 -->
                        </div>
                        <div class="text-xs-right" style="margin-left: 40px">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="サムネイル更新">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div> <!-- // end row  -->
    </section> <!-- End Thambnail Image Update Area -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subCategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subSubCategory_id"]').html('');
                        var d = $('select[name="subCategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subCategory_id"]').append('<option value="' + value.id + '">' + value.subCategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="subCategory_id"]').on('change', function() {
            var subCategory_id = $(this).val();
            if (subCategory_id) {
                $.ajax({
                    url: "{{ url('/category/sub-subCategory/ajax') }}/" + subCategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subSubCategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subSubCategory_id"]').append('<option value="' + value.id + '">' + value.subSubCategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
@endsection
