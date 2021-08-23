@extends('shop.shop_master')

@section('title')
マイカート
@endsection

@section('content')
<style>
    input[type="text"] {
        color: black;
    }
</style>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('shop.index') }}">Top</a></li>
                <li class='active'>マイカート</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">商品画像</th>
                                    <th class="cart-description item">商品名</th>
                                    <th class="cart-product-name item">カラー</th>
                                    <th class="cart-edit item">サイズ</th>
                                    <th class="cart-qty item">数量</th>
                                    <th class="cart-sub-total item">小計</th>
                                    <th class="cart-total last-item">削除</th>
                                </tr>
                            </thead><!-- /thead -->

                            <tbody id="cartPage">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">

                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if(Session::has('coupon'))
                    @else
                    <table class="table" id="couponField">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">クーポンコード</span>
                                    <p>クーポンコードをお持ちの場合は入力してください。</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon.." id="coupon_name">
                                    </div>
                                    <div class="clearfix pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">クーポンを適用</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                    @endif
                </div><!-- /.estimate-ship-tax -->

                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="couponCalField">

                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">チェックアウトに進む</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->

            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <br>
        @include('shop.body.brands')
    </div>
</div>
@endsection
