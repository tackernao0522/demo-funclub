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
                <h4 class="box-title">商品の登録 </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{ route('product-store') }}" enctype="multipart/form-data">
                            @csrf
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
                                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected': '' }}>{{ $brand->brand_name }}</option>
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
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected': '' }}>{{ $category->category_name }}</option>
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
                                                <h5>サブカテゴリー選択 <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subCategory_id" class="form-control" style="color: red">
                                                        <option value="" selected="" disabled="">--サブカテゴリー選択--</option>
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
                                                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">
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
                                                    <input type="text" name="product_code" class="form-control" value="{{ old('product_code') }}">
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
                                                    <input type="text" name="product_qty" class="form-control" value="{{ old('product_qty') }}" placeholder="半角数字を入力してください">
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
                                                    <input type="text" name="product_tags_name" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput">
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
                                                    <input type="text" name="product_size" class="form-control" value="Small,Midium,Large" data-role="tagsinput">
                                                </div>
                                                @error('product_size')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 3RD row  -->

                                    <div class="row">
                                    </div> <!-- end 4th row  -->

                                    <div class="row">
                                        <!-- start 5th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>カラー <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color" class="form-control" value="red,Black,Amet" data-role="tagsinput">
                                                    @error('product_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>価格(税込) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" value="{{ old('selling_price') }}" placeholder="半角数字を入力してください">
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>割引価格(税込) <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control" value="{{ old('discount_price') }}" placeholder="半角数字を入力してください">
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 5th row  -->

                                    <div class="row">
                                        <!-- start 6th row  -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>メインサムネイル <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)">
                                                    @error('product_thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb" alt="">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>マルチ画像 <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control" accept="image/png,image/jpeg,image/gif" multiple="" id="multiImg">
                                                    @error('multi_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="row" id="preview_img"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>商品説明(小見出し) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp" id="textarea" class="form-control" placeholder="Textarea text">{{ old('short_descp') }}</textarea>
                                                    @error('short_descp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 6th row  -->

                                    <div class="row">
                                        <!-- start 7th row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>商品説明(メイン) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_descp" rows="10" cols="80">商品説明(メイン)</textarea>
                                                    @error('long_descp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>製品詳細 <span class="text-danger">pdf,xlx,csv</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="digital_file" class="form-control">
                                                    @error('file')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 --> --}}
                                    </div> <!-- end 7th row  -->

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                                        <label for="checkbox_2">お得情報</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                                        <label for="checkbox_3">おすすめ商品</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                                                        <label for="checkbox_4">特別セール</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
                                                        <label for="checkbox_5">特別割引</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="text-xs-right">
                                        <input type="button" class="btn btn-rounded btn-primary mb-5" onclick="submit();" value="商品登録">
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
