@extends('layouts.app')
<link href="{{ asset('css/stripe.css') }}" rel="stylesheet">

@section('content')

<div id="contact" class="big-bg">
  <div class="contact-wrapper" style="max-width: 700px; padding-top: 200px">
    <h2 style="background-color: rgba(255, 255, 255, 0.5)">プレミアム会員解約</h2>
    <div class="text-justify text-left col-sm-12 cancel">
      <p>プレミアム会員解約の手続きをすると即時にプレミアム会員の特典を受けられなくなります。<br>
        一度プレミアム会員の解約手続きが完了すると再入会となりますのでその都度、料金のお支払いが発生いたしますのでご注意ください。</p>
    </div>
    <form method="POST" action="{{route('subscription.cancel', $user) }}">
      @csrf
      <button class="btn btn-danger mt-2 mb-5 col-sm-12">解約する</button>
    </form>

  </div>
</div>
@include('share.footer')
@endsection
