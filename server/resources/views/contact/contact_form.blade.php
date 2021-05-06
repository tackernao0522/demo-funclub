@extends('layouts.app')

@section('title')
Contact
@endsection

@section('content')
<div id="contact" class="big-bg">
  <div class="contact-wrapper">
    <h2 class="page-title">Contact</h2>
    @if($errors->any())
    <div class="alert alert-danger">
      @foreach($errors->all() as $message)
      <p>{{ $message }}</p>
      @endforeach
    </div>
    @endif
    <form action="{{ route('confirm') }}" , method="POST">
      @csrf
      <div class="contact">
        <label class="contact-label" for="your_name">お名前</label>
        <input type="text" id="your_name" name="your_name" value="{{ old('your_name') }}">
      </div>

      <div class="contact">
        <label class="contact-label" for="your_email">メールアドレス</label>
        <input type="email" id="your_email" name="your_email" value="{{ old('your_email') }}">
      </div>

      <div class="contact">
        <label class="contact-label" for="your_message">メッセージ</label>
        <textarea name="your_message" id="your_message">{{ old('your_message') }}</textarea>
      </div>

      <input type="submit" class="button" value="確認画面へ">
    </form>
  </div><!-- /.contact-wrapper -->
</div><!-- /#contact -->
@include('share.footer')
@endsection
