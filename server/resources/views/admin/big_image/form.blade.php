@extends('layouts.article')

@section('styles')
@include('share.flatpickr.styles')
@endsection

@section('title')
メイン画像更新
@endsection

@section('content')
<div class="header-title post">メイン画像編集ページ</div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">メイン画像を編集する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('big_info.edit', ['bigImage' => $bigImage->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="article-image">メイン画像</div>
            <span class="item-image-form image-picker">
              <input type="file" name="item-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="item-image" />
              <label for="item-image" class="d-inline-block" role="button">
                @if (!empty($bigImage->info_big_image_name))
                <img class="image-form-box" src="/storage/info-images/{{ $bigImage->info_big_image_name }}" style="object-fit: cover; width: 300px; height: 300px;">
                @else
                <img class="image-form-box" src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
              </label>
              @endif
            </span>
            <div class="form-group">
              <label class="article" for="description">本文</label>
              <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description', $bigImage->description) }}</textarea>
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
