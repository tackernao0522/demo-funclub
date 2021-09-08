<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">関連商品</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @foreach($relatedProduct as $product)
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image">
                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}"><img class="tags_page_list" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""></a>
                        </div><!-- /.image -->

                        @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount / $product->selling_price) * 100;
                        @endphp

                        <div class="tag sale">
                            <span>sale</span>
                        </div>
                    </div><!-- /.product-image -->


                    <div class="product-info text-left">
                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! Str::limit($product->product_name, 20) !!}</a></h3>
                        @include('shop.review.review_rating')
                        <!-- <div class="description"></div> -->
                        @if ($product->product_qty <= 0) <div class="product-price"><span class="price" style="color: red"> 売り切れ </span>
                    </div>
                    @else
                    <div class="product-price">
                        <span class="price" style="color: red">残在庫: {{ $product->product_qty }}</span>
                    </div>
                    @endif

                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span></span></div>
                    @else
                    <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}</span> <span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
                    @endif
                    <!-- /.product-price -->
                </div><!-- /.product-info -->
                @if ($product->product_qty <= 0) @else <div class="cart clearfix animate-effect">
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
            </div><!-- /.cart -->
            @endif
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