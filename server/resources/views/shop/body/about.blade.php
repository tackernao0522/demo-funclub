@extends('shop.shop_master')

@section('title')
About
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

<div id="content" style="height: 280px">
    <h1>About</h1>
    <p>ハーツ通販部は、ライブハウス Hearts (埼玉・西川口)、Hearts＋、Hearts Next (東京・大塚)のネットショップです。</p>
</div>
@endsection
