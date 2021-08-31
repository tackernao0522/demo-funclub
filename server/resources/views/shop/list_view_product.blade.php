@foreach($products as $product)
<div class="category-product-inner wow fadeInUp">
    <div class="products">
        <div class="product-list product">
            <div class="row product-list-row">
                <div class="col col-sm-4 col-lg-4">
                    <div class="product-image">
                        <div class="image"> <img class="list_view_product" src="{{ Storage::disk('s3')->url("products/thambnail/{$product->product_thambnail}") }}" alt=""> </div>
                    </div>
                    <!-- /.product-image -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-8 col-lg-8">
                    <div class="product-info">
                        <h3 class="name"><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_name) }}">{!! nl2br(e(Str::limit($product->product_name, 50))) !!}</a></h3>
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
                @php
                $amount = $product->selling_price - $product->discount_price;
                $discount = ($amount / $product->selling_price) * 100;
                @endphp
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
