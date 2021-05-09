@extends('layouts.app')

@section('title')
管理画面
@endsection

@section('content')
<div class="header-title"><a href="{{ route('posts.index') }}">管理者ページ</a></div>
<div class="admin-top">
  <div class="admin-top">
    <ul>
      <li><a href="{{ route('articles.create') }}">News（新規投稿）</a></li>
      <li><a href="{{ route('information.create') }}">Infomation（新規投稿）</a></li>
      <li><a href="{{ route('sell') }}">商品の出品（新規）</a></li>
      <li><a href="{{ route('sold-items') }}">販売した商品一覧</a></li>
      <li><a href="{{ route('contact.list') }}">Contactリスト</a></li>
    </ul>
  </div>
</div>
@endsection
