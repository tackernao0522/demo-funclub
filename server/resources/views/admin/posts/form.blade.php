@extends('layouts.article')

@section('styles')
@include('share.flatpickr.styles')
@endsection

@section('title')
News新規投稿
@endsection

@section('content')
<div class="header-title post"><a href="{{ route('posts.index') }}">News新規投稿ページ</a></div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">NEWSを追加する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('articles.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="article-image">ニュース画像</div>
            <span class="item-image-form image-picker">
              <input type="file" name="post_image_name" class="d-none" accept="image/png,image/jpeg,image/gif" id="post_image_name" />
              <label for="post_image_name" class="d-inline-block" role="button">
                <img class="image-form-box" src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
              </label>
            </span>
            <div class="form-group">
              <label class="article" for="primary_category">カテゴリー</label>
              <select name="primary_category" class="form-control">
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ old('primary_category') == $category->id ? 'selected' : '' }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="article" for="post_title">タイトル</label>
              <input type="text" class="form-control" name="post_title" id="post_title" value="{{ old('post_title') }}" />
            </div>
            <div class="form-group">
              <label class="article" for="post_date">作成日</label>
              <input type="text" class="form-control" name="post_date" id="post_date" value="{{ old('post_date') }}" />
            </div>
            <div class="form-group">
              <label class="article" for="body">本文</label>
              <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ old('body') }}</textarea>
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

@section('scripts')
@include('share.flatpickr.scripts')
@endsection
