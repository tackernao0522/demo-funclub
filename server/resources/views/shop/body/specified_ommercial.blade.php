@extends('shop.shop_master')

@section('title')
特定商取引法に基づく表記
@endsection

@section('content')
<style>
    #content {
        background-color: white;
        line-height: 1.5;
        width: 800px;
        padding: 20px;
        margin: 50px auto 50px;
    }

    h2 {
        margin-top: 30px;
        margin-bottom: 10px;
    }

    @media (max-width: 600px) {
        #content {
            background-color: white;
            line-height: 1.5;
            width: 100%;
            padding: 20px;
            margin: 50px auto 50px;
        }

        h1 {
            font-size: 30px;
        }

        h2 {
            margin-top: 30px;
            margin-bottom: 10px;
        }
    }
</style>

<div id="content">
    <h1>特定商取引法に基づく表記</h1>

    <h2>会社名</h2>
    <p>株式会社イーストサウンド</p>

    <h2>代表者名</h2>
    <p>伊藤大輔</p>

    <h2>事業者の所在地</h2>
    <p>郵便番号 ：170-0004</p>
    <p>住所 ：東京都豊島区北大塚2-16-7 セイコーガーデン11大塚 B1</p>

    <h2>販売価格</h2>
    <p>販売価格は、表示された金額（表示価格/消費税込）と致します。</p>

    <h2>代金の支払方法・時期</h2>
    <p>支払方法：クレジットカードによる決済がご利用頂けます。支払時期：商品注文確定時でお支払いが確定致します。</p>
    <p>代金引き換え : 注文商品お届け完了時に代金をお支払い頂きます。</p>

    <h2>商品のお届け時期</h2>
    <p>商品は主に受注生産となり、御注文から発送までに3~4週間程度を頂く場合がございます。ご了承くださいませ。</p>

    <h2>返品について</h2>
    <p>商品に欠陥がある場合を除き、基本的には返品には応じません。</p>
    <p>原則、商品交換対応となりますのでご了承くださいませ。</p>
    <p>場合により返金対応とさせて戴きます。</p>

    <footer style="margin-top: 100px">
        <div class="module-body">
            <ul class='list-unstyled'>
                <li class="first"><a href="{{ route('privacy.policy') }}" title="Privacy Policy">プライバシーポリシー</a></li>
            </ul>
        </div>
    </footer>
</div>
@endsection
