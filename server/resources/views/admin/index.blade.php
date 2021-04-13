@extends('layouts.app')

@section('title')
管理画面
@endsection

@section('content')
<div class="header-title">管理者ページ</div>
<div class="admin-top">
  <div class="admin-top">
    <ul>
      <li><a href="{{ route('posts.index') }}">News</a></li>
      <li><a href="#">Infomation</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </div>
</div>
@endsection