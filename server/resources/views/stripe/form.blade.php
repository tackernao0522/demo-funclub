@extends('layouts.app')
<link href="{{ asset('css/stripe.css') }}" rel="stylesheet">

@section('content')

<div id="contact" class="big-bg">
  <div class="contact-wrapper" style="max-width: 700px; padding-top: 200px">
    <h2 style="background-color: rgba(255, 255, 255, 0.5)">プレミアム会員入会フォーム</h2>
    <form action="{{route('stripe.afterpay')}}" method="post" id="payment-form">
      @csrf
        <label for="exampleInputEmail1" style="margin-top: 10px">お名前</label>
        <input type="test" class="form-control col-sm-12" id="card-holder-name" placeholder="カード名義(半角ローマ字)" required>
        <label for="exampleInputPassword1" style="margin-top: 10px">カード番号</label>
        <div class="form-group MyCardElement col-sm-12" id="card-element"></div>
        <div id="card-errors" role="alert" style='color:red'></div>
        <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">申し込む</button>
    </form>
  </div>
</div>
@include('share.footer')
<script src="https://js.stripe.com/v3/"></script>
<script>
// Configに設定したStripeのAPIキーを読み込む
const stripe = Stripe('{{ config('services.stripe.pb_key') }}');

const elements = stripe.elements();

var style = {
	base: {
    color: "#32325d",
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: "antialiased",
    fontSize: "16px",
    "::placeholder": {
      color: "#aab7c4"
    }
  },
  invalid: {
    color: "#fa755a",
    iconColor: "#fa755a"
  }
};

const card = elements.create('card', {style: style, hidePostalCode: true});
card.mount('#card-element');
const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

cardButton.addEventListener('click', async (e) => {
    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
              card: card,
              billing_details: { name: cardHolderName.value }
            }
        }
    );

    if (error) {
      // エラー処理
      console.log('error');

    }else {
      // 問題なければ、stripePaymentHandlerへ
      stripePaymentHandler(setupIntent);
    }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
});

function stripePaymentHandler(setupIntent) {
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripePaymentMethod');
  hiddenInput.setAttribute('value', setupIntent.payment_method);
  form.appendChild(hiddenInput);

  form.submit();
}
</script>
@endsection
