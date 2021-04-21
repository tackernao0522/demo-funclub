@extends('layouts.article')

@section('title')
Topタイトル編集
@endsection

@section('content')
<div class="header-title post">Topタイトル編集ページ</div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">Topタイトルを編集する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('top.edit', ['top' => $top]) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="article" for="main_title">メインタイトル</label>
              <input type="text" class="form-control" name="main_title" id="main_title" value="{{ old('main_title', $top->main_title) }}" />
            </div>
            <div class="form-group">
              <label class="article" for="content">コンテンツ</label>
              <input type="text" class="form-control" name="content" id="content" value="{{ old('content', $top->content) }}" />
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
