@extends('shop.shop_master')

@section('title')
@foreach($breadSubCat as $item)
{{ $item->category->category_name }}／{{ $item->subCategory_name }}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div style="overflow: hidden">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('shop.index') }}">ホーム</a></li>
                    @foreach($breadSubCat as $item)
                    <li class='active'>{{ $item->category->category_name }}</li>
                    @endforeach
                    @foreach($breadSubCat as $item)
                    <li class='active'>{{ $item->subCategory_name }}</li>
                    @endforeach
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <div class="body-content outer-top-xs" style="margin: 20px auto 0 auto !important">
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
                            <!-- ============================================== COLOR: END ============================================== -->
                            <!-- ============================================== COMPARE============================================== -->
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

                    @foreach($breadSubCat as $item)
                    <span class="badge badge-danger" style="background: #808080">{{ $item->category->category_name }}</span>
                    @endforeach
                    /
                    @foreach($breadSubCat as $item)
                    <span class="badge badge-danger" style="background: #FF0000">{{ $item->subCategory_name }}</span>
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
                            <div class="col col-sm-6 col-md-4 text-right">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- Start Product Grid View -->
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row" id="grid_view_product">
                                        @include('shop.grid_view_product')
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.category-product -->
                            </div>
                            <!-- /.tab-pane -->
                            <!-- End Product Grid View -->

                            <!-- Product List View Start -->
                            <div class="tab-pane" id="list-container">
                                <div class="category-product" id="list_view_product">
                                    @include('shop.list_view_product')
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
                <div class="ajax-loadmore-product text-center" style="display: none">
                    <img src="{{ asset('frontend/assets/images/loader.svg') }}" style="width: 120px; height: 120px">
                </div>
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('shop.body.brands')
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->
</div>

<script>
    function loadmoreProduct(page) {
        $.ajax({
                type: "GET",
                url: "?page=" + page,
                beforeSend: function(response) {
                    $('.ajax-loadmore-product').show();
                }
            })
            .done(function(data) {
                if (data.grid_view == " " || data.list_view == " ") {
                    return;
                }
                $('.ajax-loadmore-product').hide();
                $('#grid_view_product').append(data.grid_view);
                $('#list_view_product').append(data.list_view);
            })
            .fail(function() {
                alert('何かしらのエラーがあります。');
            })
    }
    var page = 1;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadmoreProduct(page);
        }
    });
</script>
@endsection
