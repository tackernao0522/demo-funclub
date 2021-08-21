@php
$categories = App\Models\Category::orderBy('id', 'ASC')->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>カテゴリー</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach($categories as $category)
            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>{{ $category->category_name }}</a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @php
                            $subCategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('id','ASC')->get();
                            @endphp
                            @foreach($subCategories as $subCategory)
                            <div class="col-sm-12 col-md-3">
                                <a href="{{ url('subCategory/product/' . $subCategory->id) }}">
                                    <h2 class="title">{{ $subCategory->subCategory_name }}</h2>
                                </a>

                                <!-- Get SubSubCategory Table Data -->
                                @php
                                $subSubCategories = App\Models\SubSubCategory::where('subCategory_id',$subCategory->id)->orderBy('id','ASC')->get();
                                @endphp
                                @foreach($subSubCategories as $subSubCategory)
                                <ul class="links list-unstyled">
                                    <li><a href="{{ url('subSubCategory/product/' . $subSubCategory->id) }}">{{ $subSubCategory->subSubCategory_name }}</a></li>
                                </ul>
                                @endforeach
                                <!-- end SubSubCategory Foreach -->
                            </div>
                            @endforeach
                            <!-- end SubCategory Foreach -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->
            @endforeach
            <!-- end Category Foreach -->
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
