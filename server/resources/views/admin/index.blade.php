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
      <li><a href="#">Infomation</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </div>
</div>
@endsection