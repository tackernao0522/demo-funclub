@extends('shop.shop_master')

@section('title')
請求番号: {{ $track->invoice_no }}の追跡結果
@endsection

@section('content')
<style type="text/css">
    /* @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap'); */

    body {
        background-color: #eeeeee;
        /* font-family: 'Open Sans', serif; */
    }

    /* .container {} */

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem;
        margin-top: 10%;
        margin-bottom: 10%;
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #157ed2;
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #157ed2;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #157ed2;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #157ed2;
        border-color: #157ed2;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #157ed2;
        border-color: #157ed2;
        border-radius: 1px
    }
</style>

<div class="container">
    <article class="card">
        <header class="card-header"><b>マイオーダー / 追跡</b></header>
        <div class="card-body">
            <div class="row" style="margin: 20px 0 0 20px">
                <div class="col-md-2">
                    <b>請求番号</b><br>
                    {{ $track->invoice_no }}
                </div> <!-- end col-md-2 -->

                <div class="col-md-2">
                    <b>購入日</b><br>
                    {{ $track->order_date }}
                </div> <!-- end col-md-2 -->

                <div class="col-md-2">
                    <b>お届け先 - {{ $track->name }} 様</b><br>
                    {{ $track->division->division_name }} / {{ $track->district->district_name }}
                </div> <!-- end col-md-2 -->

                <div class="col-md-2">
                    <b>お届け先電話番号</b><br>
                    {{ $track->phone }}
                </div> <!-- end col-md-2 -->

                <div class="col-md-2">
                    <b>お支払い方法</b><br>
                    {{ $track->payment_method }}
                </div> <!-- end col-md-2 -->

                <div class="col-md-2">
                    <b>合計金額</b><br>
                    ¥ {{ number_format($track->amount) }}(税込)
                </div> <!-- end col-md-2 -->
            </div> <!-- end row -->

            <div class="track">
                @if($track->status == 'pending')
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">未対応</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">確認済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">対応中</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送可能</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">配達完了</span> </div>

                @elseif($track->status == 'confirm')
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">未対応</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">確認済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">対応中</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送可能</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">配達完了</span> </div>

                @elseif($track->status == 'processing')
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">未対応</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">確認済</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">対応中</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送可能</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">配達完了</span> </div>

                @elseif($track->status == 'picked')
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">未対応</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">確認済</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">対応中</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送可能</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">配達完了</span> </div>

                @elseif($track->status == 'shipped')
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">未対応</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">確認済</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">対応中</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送可能</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送済</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">配達完了</span> </div>

                @elseif($track->status == 'delivered')
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">未対応</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">確認済</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">対応中</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送可能</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">発送済</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check" style="margin-top: 13px"></i> </span> <span class="text">配達完了</span> </div>
                @endif
            </div> <!-- end track -->
            <hr><br><br>
        </div>
    </article>
</div>
@endsection