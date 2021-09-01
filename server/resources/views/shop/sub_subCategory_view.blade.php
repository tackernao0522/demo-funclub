@extends('shop.shop_master')

@section('title')
@foreach($breadSubSubCat as $item)
{{ $item->category->category_name }}／{{ $item->subCategory->subCategory_name }}／{{ $item->subSubCategory_name }}
@endforeach
@endsection

@section('content')
<style>
    img.grid_view_product {
        width: 249px;
        height: 249px;
    }

    img.list_view_product {
        width: 249px;
        height: 249px;
    }

    .checked {
        color: orange;
    }

    @media (max-width: 600px) {
        img.grid_view_product {
            max-width: 307px !important;
            max-height: 334px !important;
        }

        img.list_view_product {
            max-width: 307px !important;
            max-height: 334px !important;
        }
    }
</style>

<div style="overflow: hidden">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('shop.index') }}">ホーム</a></li>
                    @foreach($breadSubSubCat as $item)
                    <li class='active'>{{ $item->category->category_name }}</li>
                    @endforeach
                    @foreach($breadSubSubCat as $item)
                    <li class='active'>{{ $item->subCategory->subCategory_name }}</li>
                    @endforeach
                    @foreach($breadSubSubCat as $item)
                    <li class='active'>{{ $item->subSubCategory_name }}</li>
                    @endforeach
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row'>
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('shop.common.vertical_menu')
                    <!-- ================================== TOP NAVIGATION : END ================================== -->
                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <h3 class="section-title">shop by</h3>
                                <div class="widget-header">
                                    <h4 class="widget-title">カテゴリー</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="accordion">
                                        @foreach($categories as $category)
                                        <div class="accordion-group">
                                            <div class="accordion-heading"> <a href="#collapseOne{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">{{ $category->category_name }}</a> </div>
                                            <!-- /.accordion-heading -->
                                            <div class="accordion-body collapse" id="collapseOne{{ $category->id }}" style="height: 0px;">
                                                <div class="accordion-inner">
                                                    @php
                                                    $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('id','ASC')->get();
                                                    @endphp
                                                    @foreach($subCategories as $subCategory)
                                                    <ul>
                                                        <li><a href="{{ url('subCategory/product/'.$subCategory->id) }}">{{ $subCategory->subCategory_name }}</a></li>
                                                    </ul>
                                                    @endforeach
                                                </div>
                                                <!-- /.accordion-inner -->
                                            </div>
                                            <!-- /.accordion-body -->
                                        </div>
                                        <!-- /.accordion-group -->
                                        @endforeach
                                    </div>
                                    <!-- /.accordion -->
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                            <!-- ============================================== PRICE SILDER============================================== -->
                            <!-- ============================================== PRICE SILDER : END ============================================== -->
                            <!-- ============================================== MANUFACTURES============================================== -->
                            <!-- ============================================== MANUFACTURES: END ============================================== -->
                            <!-- ============================================== COLOR============================================== -->
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== COLOR: END ============================================== -->
                            <!-- ============================================== COMPARE============================================== -->
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== COMPARE: END ============================================== -->
                            <!-- ============================================== PRODUCT TAGS ============================================== -->
                            @include('shop.common.product_tags')
                            <!-- ============================================== END PRODUCT TAGS ============================================== -->
                            <!----------- Testimonials------------->
                            @include('shop.common.testimonials')
                            <!-- ============================================== Testimonials: END ============================================== -->
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->
                </div>
                <!-- /.sidebar -->
                <div class='col-md-9'>
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div id="category" class="category-carousel hidden-xs">
                        <div class="item">
                            <div class="image"> <img src="{{ asset('frontend/assets/images/banners/cat-banner-1.jpg') }}" alt="" class="img-responsive"> </div>
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="big-text">ビッグセール</div>
                                    <div class="excerpt hidden-sm hidden-md">最大49%OFF</div>
                                    <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                    </div>

                    @foreach($breadSubSubCat as $item)
                    <span class="badge badge-danger" style="background: #808080">{{ $item->category->category_name }}</span>
                    @endforeach
                    /
                    @foreach($breadSubSubCat as $item)
                    <span class="badge badge-danger" style="background: #808080">{{ $item->subCategory->subCategory_name }}</span>
                    @endforeach
                    /
                    @foreach($breadSubSubCat as $item)
                    <span class="badge badge-danger" style="background: #FF0000">{{ $item->subSubCategory_name }}</span>
                    @endforeach

                    <div class="clearfix filters-container m-t-10">
                        <div class="row">
                            <div class="col col-sm-6 col-md-2">
                                <div class="filter-tabs">
                                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>グリッド</a> </li>
                                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>リスト</a></li>
                                    </ul>
                                </div>
                                <!-- /.filter-tabs -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- Start Product Grid View -->
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row">
                                        @foreach($products as $product)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="grid_view_product" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
                                                        <!-- /.image -->

                                                        @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                        @endphp

                                                        <div>
                                                            @if ($product->discount_price == NULL)
                                                            <div class="tag new"><span>新着</span></div>
                                                            @else
                                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 30) !!}</a></h3>
                                                        @php
                                                        $reviewCount = App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get();
                                                        $avarage = App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
                                                        @endphp
                                                        <div class="rating">
                                                            @if($avarage == 0)
                                                            評価はまだありません。
                                                            @elseif($avarage == 1 || $avarage < 2) <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                @elseif($avarage == 2 || $avarage < 3) <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    @elseif($avarage == 3 || $avarage < 4) <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        @elseif($avarage == 4 || $avarage < 5) <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            @elseif($avarage == 5 || $avarage < 5) <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                @endif
                                                        </div>
                                                        <!-- <div class="description"></div> -->
                                                        @if ($product->discount_price == NULL)
                                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></div>
                                                        @else
                                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ $product->selling_price }}</span> </div>
                                                        @endif
                                                        <!-- /.product-price -->
                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="button">カートに入れる</button>
                                                                </li>
                                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->
                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        <!-- /.item -->
                                        @endforeach
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.category-product -->
                            </div>
                            <!-- /.tab-pane -->
                            <!-- End Product Grid View -->

                            <!-- Product List View Start -->
                            <div class="tab-pane " id="list-container">
                                <div class="category-product">
                                    @foreach($products as $product)
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">
                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image"> <img class="grid_view_product" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_name) }}">{!! nl2br(e(Str::limit($product->product_name, 50))) !!}</a></h3>
                                                            @php
                                                            $reviewCount = App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get();
                                                            $avarage = App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
                                                            @endphp
                                                            <div class="rating">
                                                                @if($avarage == 0)
                                                                評価はまだありません。
                                                                @elseif($avarage == 1 || $avarage < 2)
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($avarage == 2 || $avarage < 3)
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($avarage == 3 || $avarage < 4)
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($avarage == 4 || $avarage < 5)
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                @elseif($avarage == 5 || $avarage < 5)
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                @endif
                                                            </div>
                                                            @if ($product->discount_price == NULL)
                                                            <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></div>
                                                            @else
                                                            <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
                                                            @endif
                                                            <!-- /.product-price -->
                                                            <div class="description m-t-10">
                                                                {{ $product->short_descp }}
                                                            </div>
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                                            <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)">カートに入れる</button>
                                                                        </li>
                                                                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product-info -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-list-row -->
                                                @if ($product->discount_price == NULL)
                                                <div class="tag new"><span>新着</span></div>
                                                @else
                                                <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-list -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.category-product-inner -->
                                    <!-- End Product List View -->
                                    @endforeach
                                </div>
                                <!-- /.category-product -->
                            </div>
                            <!-- /.tab-pane #list-container -->
                        </div>
                        <!-- /.tab-content -->
                        <div class="clearfix filters-container">
                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}
                                    </ul>
                                    <!-- /.list-inline -->
                                </div>
                                <!-- /.pagination-container -->
                            </div>
                            <!-- /.text-right -->
                        </div>
                        <!-- /.filters-container -->
                    </div>
                    <!-- /.search-result-container -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('shop.body.brands')
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
</div>
<!-- /.body-content -->
@endsection
