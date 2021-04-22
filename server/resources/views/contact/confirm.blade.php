@extends('layouts.app')

@section('title')
入力確認
@endsection

@section('content')
<div id="contact" class="big-bg">
  @include('share.home_header')

  <div class="contact-wrapper">
    <h2 class="page-title">入力確認</h2>
    <form action="{{ route('process') }}" , method="POST">
      @csrf
      <div class="contact">
        <label class="contact-label" for="your_name">お名前</label>
        <div class="contact-detail">
          {{ $inputs['your_name'] }}
        </div>
        <input type="hidden" id="your_name" name="your_name" value="{{ $inputs['your_name'] }}">
      </div>

      <div class="contact">
        <label class="contact-label" for="your_email">メールアドレス</label>
        <div class="contact-detail">
          {{ $inputs['your_email'] }}
        </div>
        <input type="hidden" id="your_email" name="your_email" value="{{ $inputs['your_email'] }}">
      </div>

      <div class="contact">
        <label class="contact-label" for="your_message">メッセージ</label>
        <div class="contact-message-detail">
          {!! nl2br(e( $inputs['your_message'] )) !!}
        </div>
        <input type="hidden" name="your_message" value="{{ $inputs['your_message'] }}">
      </div>
      <button name="action" type="submit" value="return" class="btn btn-dark">入力画面に戻る</button>
      <button name="action" type="submit" value="submit" class="btn btn-primary" style="width: 95px">送信</button>
    </form>
  </div><!-- /.contact-wrapper -->
</div><!-- /#contact -->
@include('share.footer')
@endsection