@extends('layouts.app')

@section('title')
管理画面
@endsection

@section('content')
<div class="header-title">管理者ページ</div>
<div class="admin-top">
  <div class="row">
    <div class="col-12">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">News</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Information</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
      </div>
    </div>
  </div>
</div>
@endsection
