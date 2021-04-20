@extends('layouts.article')

@section('title')
Info編集
@endsection

@section('content')
<div class="header-title post">Info編集ページ</div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">INFOを編集する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('small_image.edit', ['smallImage' => $smallImage->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="article-image">INFO画像</div>
            <span class="item-image-form image-picker">
              <input type="file" name="info_image_name" class="d-none" accept="image/png,image/jpeg,image/gif" id="info_image_name" />
              <label for="info_image_name" class="d-inline-block" role="button">
                @if (!empty($smallImage->info_image_name))
                <img class="image-form-box" src="/storage/info-images/{{ $smallImage->info_image_name }}" style="object-fit: cover; width: 300px; height: 300px;">
                @else
                <img class="image-form-box" src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
              </label>
              @endif
            </span>
            <div class="form-group">
              <label class="article" for="description">本文</label>
              <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description', $smallImage->description) }}</textarea>
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
