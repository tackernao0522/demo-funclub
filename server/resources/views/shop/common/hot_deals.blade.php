@php
$hot_deals = App\Models\Product::where('hot_deals', 1)
->where('discount_price', '!=', NULL)
->orderBy('id', 'DESC')->limit(3)->get();
@endphp
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">お買い得品</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach($hot_deals as $product)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""> </div>

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount / $product->selling_price) * 100;
                    @endphp

                    @if ($product->discount_price == NULL)
                    <div class="sale-offer-tag"><span>新着<br>注目!</span></div>
                    @else
                    <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                            off</span></div>
                    @endif
                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{{ $product->product_name }}</a></h3>
                    @include('shop.review.review_rating')
                    @if ($product->product_qty <= 0)
                        <div class="product-price">
                            <span class="price" style="color: red"> 売り切れ </span>
                        </div>
                    @else
                        <div class="product-price">
                            <span class="price" style="color: red">残在庫: {{ $product->product_qty }}</span>
                        </div>
                    @endif
                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price">¥ {{ number_format($product->selling_price) }}</span>(税込) </div>
                    @else
                    <div class="product-price"> <span class="price">¥ {{ number_format($product->discount_price) }}(税込) </span><span class="price-before-discount">¥ {{ number_format($product->selling_price) }}</span> </div>
                    @endif
                    <!-- /.product-price -->

                </div>
                <!-- /.product-info -->

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
            </div>
        </div>
        @endforeach
        <!-- end hot deals foreach -->
    </div>
    <!-- /.sidebar-widget -->
</div>
