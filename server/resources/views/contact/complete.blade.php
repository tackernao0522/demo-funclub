@extends('layouts.app')

@section('title')
お問い合わせ確認
@endsection

@section('content')
<div id="contact" class="big-bg">
  <div class="contact-wrapper">
    <h2 class="page-title">完了しました。</h2>
    <div class="text-center">
      <h1 class="text-center mt-2 mb-5">お問い合わせありがとうございました。</h1>
      <a href="{{ route('contact.form') }}" class="btn btn-primary">お問い合わせ入力画面に戻る</a>
    </div>
  </div><!-- /.contact-wrapper -->
</div><!-- /#contact -->
@include('share.footer')
@endsection
