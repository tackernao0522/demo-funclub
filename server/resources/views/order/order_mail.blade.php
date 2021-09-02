<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>領収書</title>

    <style type="text/css">
        * {
            font-family: ipaexg;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            font-size: 16px;
            font-weight: normal;
            font-family: ipaexg;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>EasyShop - 注文確認</strong></h2>
            </td>
        </tr>
        <td align="left">
            <p class="font" style="margin-left: 20px;">
                <strong>ファンクラブ事務局</strong><br>
                <strong>TEL : </strong>03-111-1111<br>
                <strong>〒182-0024</strong><br>
                <strong>東京都調布市布田2-18-2 メゾン調布103</strong><br><br>
            </p>
        </td>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width=" 100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>請求書番号(オーダー番号):</strong> {{ $order['invoice_no'] }}<br>
                    <strong>お支払い額:</strong> ¥ {{ number_format($order['amount']) }}<br>
                    <strong>お名前:</strong> {{ $order['name'] }} 様<br>
                    <strong>メールアドレス:</strong> {{ $order['email']  }} <br><br>
                </p>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <div class="thanks mt-3">
        <p>お買い上げ誠に有難うございました。</p>
    </div>
    <!-- <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div> -->
</body>

</html>