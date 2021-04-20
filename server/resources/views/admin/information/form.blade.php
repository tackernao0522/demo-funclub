@extends('layouts.article')

@section('title')
Info新規投稿
@endsection

@section('content')
<div class="header-title post"><a href="{{ route('info.index') }}">Info新規投稿ページ</a></div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">INFOMATIONを追加する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('information.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="article-image">INFO画像</div>
            <span class="item-image-form image-picker">
              <input type="file" name="info_image_name" class="d-none" accept="image/png,image/jpeg,image/gif" id="info_image_name" />
              <label for="info_image_name" class="d-inline-block" role="button">
                <img class="image-form-box" src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
              </label>
            </span>
            <div class="form-group">
              <label class="article" for="description">本文</label>
              <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">投稿</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection
