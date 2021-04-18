@extends('layouts.article')

@section('styles')
@include('share.flatpickr.styles')
@endsection

@section('title')
サブタイトルの更新
@endsection

@section('content')
<div class="header-title post">サブタイトル更新ページ</div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">サブタイトルを編集する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('edit', ['subTitle' => $subTitle->id]) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="article" for="sub_title">タイトル</label>
              <input type="text" class="form-control" name="sub_title" id="sub_title" value="{{ old('sub_title', $subTitle->sub_title) }}" />
            </div>
            <div class="form-group">
              <label class="article" for="desctription">サブタイトルの説明</label>
              <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('descripiton', $subTitle->description) }}</textarea>
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
