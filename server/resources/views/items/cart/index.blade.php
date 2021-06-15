@extends('layouts.client_layout')

@section('title')
カート
@endsection

@section('content')
<!-- start content -->
<div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('items.index') }}">Online Shop</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Cart</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>商品名</th>
                                <th>値段</th>
                                <th>数量</th>
                                <th>小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Session::has('cart'))
                            @foreach($items as $item)
                            <tr class="text-center">
                                <td class="product-remove"><a href="{{-- url('/remove_from_cart/' . $product['product_id']) --}}"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url({{ Storage::disk('s3')->url("item-images/{$item['item_image_name']}") }})"></div>
                                </td>

                                <td class="product-name">
                                    <h3>{{ $item['item_name'] }}</h3>
                                    <p>{{ $item['delivery_time_id'] }}</p>
                                </td>

                                <td class="price">¥{{ number_format($item['item_price']) }}</td>
                                <form action="{{-- url('/update_qty/'.$product['product_id']) --}}" method="POST">
                                    @csrf
                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                            <input type="number" name="quantity" class="quantity form-control input-number" value="{{ $item['qty'] }}" min="1" max="100">
                                        </div>
                                        <input type="submit" class="btn btn-success" value="数量変更">
                                    </td>
                                </form>


                                <td class="total">¥{{ number_format($item['qty'] * $item['item_price']) }}</td>
                            </tr><!-- END TR-->
                            @endforeach
                            @else
                            @if (Session::has('status'))
                            <div class="alert alert-success">
                                {{ Session::get('status') }}
                            </div>
                            @endif
                            @endif
                        </tbody>
                    </table>
                    @if (!Session::has('cart'))
                    <h3 style="text-align: center; color: crimson">カートの中身はありません。</h3>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Sample Text</h3>
                    <p>サンプル サンプル サンプル</p>
                    <!-- <form action="#" class="info">
                        <div class="form-group">
                            <label for="">Coupon code</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                    </form> -->
                </div>
                <!-- <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p> -->
            </div>
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Sample Text</h3>
                    <p>サンプル サンプル サンプル</p>
                    <!-- <form action="#" class="info">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="country">State/Province</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="country">Zip/Postal Code</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                    </form> -->
                </div>
                <!-- <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p> -->
            </div>
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>カートの中身合計</h3>
                    <p class="d-flex">
                        <span>小計</span>
                        <span>¥{{ number_format(Session::has('cart') ? Session::get('cart')->totalPrice : 0) }}</span>
                    </p>
                    <!-- <p class="d-flex">
                        <span>Delivery</span>
                        <span>$0.00</span>
                    </p> -->
                    <!-- <p class="d-flex">
                        <span>Discount</span>
                        <span>$3.00</span>
                    </p> -->
                    <hr>
                    <p class="d-flex total-price">
                        <span>合計金額(税込)</span>
                        <span>¥{{ number_format(Session::has('cart') ? Session::get('cart')->totalPrice : 0) }}</span>
                    </p>
                </div>
                <p><a href="{{ url('/checkout') }}" class="btn btn-primary py-3 px-4">決済ページへ</a></p>
            </div>
        </div>
    </div>
</section>

<!-- end content -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>
@endsection
