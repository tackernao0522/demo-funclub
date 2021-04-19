@extends('layouts.article')

@section('styles')
@include('share.flatpickr.styles')
@endsection

@section('title')
ヘッダー文の更新
@endsection

@section('content')
<div class="header-title post">INFOヘッダー文編集</div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">INFOヘッダー文の編集</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="" method="POST">
            @csrf
            <div class="form-group">
              <label class="article" for="body">INFOヘッダー文</label>
              <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ old('body', $headerBody->body) }}</textarea>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-success">更新</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection
