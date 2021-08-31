@extends('shop.shop_master')

@section('title')
Home Easy Online Shop
@endsection

@section('content')
<style>
    img.product_index {
        width: 189px;
        height: 206px;
    }

    .checked {
        color: orange;
    }

    @media (max-width: 600px) {
        img.product_index {
            width: 307px;
            height: 307px;
        }
    }
</style>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ================================== TOP NAVIGATION ================================== -->
                @include('shop.common.vertical_menu')
                <!-- ================================== TOP NAVIGATION : END ================================== -->

                <!-- ============================================== HOT DEALS ============================================== -->
                @include('shop.common.hot_deals')
                <!-- ============================================== HOT DEALS: END ============================================== -->

                <!-- ============================================== SPECIAL OFFER ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">特別セール</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            <div class="item">
                                <div class="products special-product">
                                    @foreach($special_offer as $product)
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"> <img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""> </a> </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info" style="margin-right: 10px">
                                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{{ $product->product_name }}</a></h3>
                                                        @include('shop.review.review_rating')
                                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span> </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                    @endforeach
                                    <!-- end special offer foreach -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                <!-- ============================================== PRODUCT TAGS ============================================== -->
                @include('shop.common.product_tags')
                <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                <!-- ============================================== SPECIAL DEALS ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">特別割引</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            <div class="item">
                                <div class="products special-product">
                                    @foreach($special_deals as $product)
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"> <img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""> </a> </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info" style="margin-right: 10px">
                                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{{ $product->product_name }}</a></h3>
                                                        @include('shop.review.review_rating')
                                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span> </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                    @endforeach
                                    <!-- end special deals foreach -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                <!-- ============================================== NEWSLETTER ============================================== -->
                <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
                    <h3 class="section-title">Newsletters</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <p>Sign Up for Our Newsletter!</p>
                        <form>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                            </div>
                            <button class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== NEWSLETTER: END ============================================== -->

                <!-- ============================================== Testimonials============================================== -->
                @include('shop.common.testimonials')
                <!-- ============================================== Testimonials: END ============================================== -->
            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        @foreach($sliders as $slider)
                        <div class="item" style="background-image: url({{ Storage::disk('s3')->url("sliders/{$slider->slider_img}") }}">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="big-text fadeInDown-1"> {{ $slider->title }} </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.item -->
                        @endforeach
                    </div>
                    <!-- /.owl-carousel -->
                </div>

                <!-- ========================================= SECTION – HERO : END ========================================= -->

                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">返金保証</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">30日間の返金保証</h6>
                                </div>
                            </div>
                            <!-- .col -->

                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">送料無料</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">10,000円以上購入で送料無料</h6>
                                </div>
                            </div>
                            <!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">特売</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">すべての商品がさらに500円OFF</h6>
                                </div>
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.info-boxes-inner -->

                </div>
                <!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->

                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">新商品(新入荷)</h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">全て</a></li>

                            @foreach($categories as $category)
                            <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">{{ $category->category_name }}</a></li>
                            @endforeach
                            <!-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>

                            <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li> -->
                        </ul>
                        <!-- /.nav-tabs -->
                    </div>
                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    @foreach($products as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
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
                                                    <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>

                                                    @include('shop.review.review_rating')
                                                    <!-- <div class="description"></div> -->

                                                    @if ($product->discount_price == NULL)
                                                    <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></div>
                                                    @else
                                                    <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                                    <!-- end all product foreach -->
                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->

                        @foreach($categories as $category)
                        <div class="tab-pane" id="category{{ $category->id }}">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    @php
                                    $catwiseProduct = App\Models\Product::where('category_id', $category->id)->orderBy('id', 'DESC')->get();
                                    @endphp
                                    @forelse($catwiseProduct as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
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
                                                    <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                                                    @include('shop.review.review_rating')
                                                    <!-- <div class="description"></div> -->

                                                    @if ($product->discount_price == NULL)
                                                    <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                                    @else
                                                    <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                                    @empty
                                    <h5 class="text-danger">商品はありません。</h5>
                                    @endforelse
                                    <!-- end all product foreach -->
                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                        @endforeach
                        <!-- end category foreach -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('/frontend/assets/images/banners/home-banner1.jpg') }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('/frontend/assets/images/banners/home-banner2.jpg') }}" alt=""> </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->

                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">おすすめ商品</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($featured as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
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
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                                        @include('shop.review.review_rating')
                                        <!-- <div class="description"></div> -->

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                        @else
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                <!-- ============================================== skip_product_0 PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">{{ $skip_category_0->category_name }}</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($skip_product_0 as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
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
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                                        @include('shop.review.review_rating')
                                        <!-- <div class="description"></div> -->

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                        @else
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== skip_product_0 PRODUCTS : END ============================================== -->

                <!-- ============================================== skip_product_1 PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">{{ $skip_category_1->category_name }}</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($skip_product_1 as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
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
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                                        @include('shop.review.review_rating')
                                        <!-- <div class="description"></div> -->

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                        @else
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== skip_product_1 PRODUCTS : END ============================================== -->

                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/home-banner.jpg') }}" alt=""> </div>
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="new-label">
                                    <div class="text">新着</div>
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

                <!-- ============================================== skip_brand_product_1 PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">{{ $skip_brand_9->brand_name }}</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($skip_brand_product_9 as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                        @endphp

                                        <div>
                                            @if ($product->discount_price == NULL)
                                            <div class="tag new"><span>新着 </span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                                        @include('shop.review.review_rating')
                                        <!-- <div class="description"></div> -->

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                        @else
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== skip_brand_product_1 PRODUCTS : END ============================================== -->

                <!-- ============================================== BEST SELLER ============================================== -->

                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">{{ $skip_category_10->category_name }}</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($skip_product_10 as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                        @endphp

                                        <div>
                                            @if ($product->discount_price == NULL)
                                            <div class="tag new"><span>新着 </span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{{ $product->product_name }}</a></h3>
                                        @include('shop.review.review_rating')
                                        <!-- <div class="description"></div> -->

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                        @else
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->

                <!-- ============================================== BLOG SLIDER ============================================== -->
                <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                    <h3 class="section-title">ホームブログ</h3>
                    <div class="blog-slider-container outer-top-xs">
                        <div class="owl-carousel blog-slider custom-carousel">
                            @foreach($blogPosts as $blog)
                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="blog.html"><img src="{{ Storage::disk('s3')->url("blogs/{$blog->post_blog_image}") }}" alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="#">{{ $blog->post_blog_title }}</a></h3>
                                        <span class="info">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</span>
                                        <p class="text">{!! Str::limit($blog->post_blog_details, 100) !!}</p>
                                        <a href="{{ route('blogPost.details', $blog->id) }}" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->
                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->
                            @endforeach
                        </div>
                        <!-- /.owl-carousel -->
                    </div>
                    <!-- /.blog-slider-container -->
                </section>
                <!-- /.section -->
                <!-- ============================================== BLOG SLIDER : END ============================================== -->

                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">{{ $skip_brand_4->brand_name }}</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($skip_brand_product_4 as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="product_index" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                        @endphp

                                        <div>
                                            @if ($product->discount_price == NULL)
                                            <div class="tag new"><span>新着 </span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                                        @include('shop.review.review_rating')
                                        <!-- <div class="description"></div> -->

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                                        @else
                                        <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
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
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        @include('shop.body.brands')

        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
@endsection