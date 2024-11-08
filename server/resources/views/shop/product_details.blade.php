@extends('shop.shop_master')

@section('title')
{{ $product->product_name }}
商品の詳細
@endsection

@section('content')
<style>
    .checked {
        color: orange;
    }

    img.tags_page_list {
        width: 189px !important;
        height: 206px !important;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input input {
        background: none repeat scroll 0 0 #fff;
        border: 1px solid #f2f2f2;
        box-sizing: border-box;
        font-size: 15px;
        height: 35px;
        left: 0;
        padding: 0 10px 0 10px;
        position: absolute;
        top: 0;
        width: 70px;
        z-index: 1;
    }

    @media (max-width: 600px) {
        img.tags_page_list {
            width: 307px !important;
            height: 335px !important;
        }
    }
</style>
<!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('shop.index') }}">Home</a></li>
                <li class='active'>{{ $product->product_name }}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('shop.common.hot_deals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== NEWSLETTER ============================================== -->
                    @include('shop.news.subscribe_news')
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget  wow fadeInUp outer-top-vs" style="margin-bottom: 80px">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member1.png') }}" alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">John Doe <span>Abc Company</span> </div><!-- /.container-fluid -->
                            </div><!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member3.png') }}" alt="Image"></div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                            </div><!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img src="{{ asset('frontend/assets/images/testimonials/member2.png') }}" alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div><!-- /.container-fluid -->
                            </div><!-- /.item -->
                        </div><!-- /.owl-carousel -->
                    </div>
                    <!-- ============================================== Testimonials: END ============================================== -->
                </div>
            </div><!-- /.sidebar -->
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    @foreach($multiImage as $img)
                                    <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                        <a data-lightbox="image-1" data-title="Gallery" href="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}">
                                            <img class="img-responsive" alt="" src="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}" data-echo="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}">
                                        </a>
                                    </div><!-- /.single-product-gallery-item -->
                                    @endforeach
                                </div><!-- /.single-product-slider -->

                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        @foreach($multiImage as $img)
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                <img class="img-responsive" width="85" alt="" src="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}" data-echo="{{ Storage::disk('s3')->url("products/multi-image/{$img->photo_name}") }}">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->
                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->

                        @php
                        $reviewCount = App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get();
                        $avarage = App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
                        @endphp

                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name" id="pname">{{ $product->product_name }}</h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
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
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(レビュー数: {{ count($reviewCount) }})</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        @if($product->product_qty <= 0)
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">残在庫 :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">売り切れ</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">残在庫 :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">{{ $product->product_qty }}点</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                    {{ $product->short_descp }}
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if ($product->discount_price == NULL)
                                                <span class="price">¥ {{ number_format($product->selling_price) }}</span><span>(税込)</span>
                                                @else
                                                <span class="price">¥ {{ number_format($product->discount_price) }}</span><span style="font-size: 10px">(税込)</span>
                                                <span class="price-strike">¥ {{ number_format($product->selling_price) }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($product->product_qty <= 0)
                                        @else
                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <button class="btn btn-primary" type="button" id="{{ $product->id }}" onclick="addToWishList(this.id)" data-placement="right" title="Wishlist" style="background: #108bea">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <!-- Add Product Color And Size -->
                                @if($product->product_qty <= 0)
                                @else
                                <div class="row">

                                </div><!-- /.row -->
                                <!-- End Add Product Color And Size -->

                                <div class="quantity-container info-container">
                                        @if ($product->product_qty <= 0)
                                        @else
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <div class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)">カートに入れる</button>
                                                </div>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                        @endif
                                </div><!-- /.quantity-container -->
                                @endif

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>

                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">詳細説明</a></li>
                                <li><a data-toggle="tab" href="#review">レビュー</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">
                                            {!! $product->long_descp !!}
                                        </p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">
                                        <div class="product-reviews">
                                            <h4 class="title">お客様レビュー</h4>

                                            @php
                                            $reviews = App\Models\Review::where('product_id', $product->id)->latest()->limit(5)->get();
                                            @endphp

                                            <div class="reviews">
                                                @foreach($reviews as $item)
                                                @if($item->status == 0)
                                                @else
                                                <div class="review">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if ($item->user->role === 'admin')
                                                            <img style="border-radius: 50%" src="{{ (!empty($item->user->profile_photo_path)) ? Storage::disk('s3')->url("admin-profile/{$item->user->profile_photo_path}") : url('upload/no_image.jpg') }}" alt="" width="40px" height="40px"><b>{{ $item->user->name }}</b>
                                                            @else
                                                            <img style="border-radius: 50%" src="{{ (!empty($item->user->profile_photo_path)) ? Storage::disk('s3')->url("user-profile/{$item->user->profile_photo_path}") : url('upload/no_image.jpg') }}" alt="" width="40px" height="40px"><b>{{ $item->user->name }}</b>
                                                            @endif

                                                            @if ($item->rating == NULL)
                                                            @elseif($item->rating == 1)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            @elseif($item->rating == 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            @elseif($item->rating == 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            @elseif($item->rating == 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            @elseif($item->rating == 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </div> <!-- end row -->

                                                    <div class="review-title"><span class="summary">{{ $item->summary }}</span><span class="date"><i class="fa fa-calendar"></i><span>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span></span></div>
                                                    <div class="text">"{!! nl2br(e($item->comment)) !!}"</div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->

                                        <div class="product-add-review">
                                            <h4 class="title">レビューを投稿する</h4>
                                            <div class="review-table">

                                            </div><!-- /.review-table -->

                                            <div class="review-form">
                                                @guest
                                                <p><b>製品レビューを投稿するには、ログインする必要があります。<a href="{{ route('login') }}">ログインはこちら</a></b></p>
                                                @else
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form" method="POST" action="{{ route('review.store', $product->id) }}">
                                                        @csrf
                                                        <table class="table" style="display: block; overflow-x: scroll; white-space: nowrap; -webkit-overflow-scrolling: touch">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-label">&nbsp;</th>
                                                                    <th>1 star</th>
                                                                    <th>2 stars</th>
                                                                    <th>3 stars</th>
                                                                    <th>4 stars</th>
                                                                    <th>5 stars</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-label">評価</td>
                                                                    <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table><!-- /.table .table-bordered -->

                                                        <div class="row">
                                                            <div class="col-sm-6">

                                                                <div class="form-group">
                                                                    <label for="exampleInputSummary">概要<span class="astk">*</span></label>
                                                                    <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" placeholder="" value="{{ old('summary') }}">
                                                                    @error('summary')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div><!-- /.form-group -->
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">レビュー<span class="astk">*</span></label>
                                                                    <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4" placeholder="">{{ old('comment') }}</textarea>
                                                                    @error('comment')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                        </div><!-- /.row -->

                                                        <div class="action text-right">
                                                            <button type="submit" class="btn btn-primary btn-upper">レビューを投稿</button>
                                                        </div><!-- /.action -->
                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                                @endguest
                                            </div><!-- /.review-form -->
                                        </div><!-- /.product-add-review -->
                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                @include('shop.product.related_product')
                <!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->
    </div>
</div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-610a3df0f395b76e"></script>

@endsection
