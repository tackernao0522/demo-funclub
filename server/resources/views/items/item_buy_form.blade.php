@extends('layouts.client_layout')

@section('title')
お支払い
@endsection

@section('content')
<!-- start content -->
<div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('items.index') }}">Online Shop</a></span> <span>お支払い</span></p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="col-12 offset-2 text-center status-alert mt-3" id="status-alert" style="margin: 0 auto; width: 67%">
        @if (session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session::get('error') }}
        </div>
        @endif
    </div>
    <div class="col-12 offset-2 text-center status-alert mt-3" id="status-alert" style="margin: 0 auto; width: 67%">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="col-12 offset-2 text-center status-alert mt-3" id="status-alert" style="margin: 0 auto; width: 67%">
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
        </div>
        @endif
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form action="{{ route('items.buy') }}" method="POST" class="billing-form" id="checkout-form">
                    @csrf
                    <h3 class="mb-4 billing-heading">お支払い内容入力</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">お名前(フルネーム)</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">郵便番号</label>
                                <input type="text" class="form-control" name="zip_code" placeholder="半角数字で入力してください" value="{{ old('zip_code') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">お届け先住所</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">電話番号</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="半角数字で入力してください" value="{{ old('phone_number') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">カード名義</label>
                                <input type="text" class="form-control" id="card-name" placeholder="英ローマ字" name="card_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">カード番号</label>
                                <input type="text" class="form-control" id="card-number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">有効月</label>
                                <input type="text" id="card-expiry-month" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">有効年</label>
                                <input type="text" id="card-expiry-year" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">CVC</label>
                                <input type="text" id="card-cvc" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="決済をする">
                            </div>
                        </div>
                    </div>
                </form><!-- END -->
            </div>
            <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">お支払い合計</h3>
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
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section> <!-- .section -->

<!-- end content  -->
@endsection


@section('scripts')
<script src="https://js.stripe.com/v2/"></script>
<script src="src/js/checkout.js"></script>
<script>
    Stripe.setPublishableKey('{{ config('services.stripe.pb_key') }}');

    var $form = $('#checkout-form');

    $form.submit(function(event) {
        $('#charge-error').addClass('hidden');
        $form.find('button').prop('disabled', true);
        Stripe.card.createToken({
            number: $('#card-number').val(),
            cvc: $('#card-cvc').val(),
            exp_month: $('#card-expiry-month').val(),
            exp_year: $('#card-expiry-year').val(),
            name: $('#card-name').val()
        }, stripeResponseHandler);
        return false;
    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#charge-error').removeClass('hidden');
            $('#charge-error').text(response.error.message);
            $form.find('button').prop('disabled', false);
        } else {
            var token = response.id;
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));

            // submit the form:
            $form.get(0).submit();

        }
    }
</script>

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
