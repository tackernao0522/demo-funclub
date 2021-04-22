@extends('layouts.app')

@section('title')
Contactリスト
@endsection

@section('content')
<div class="header-title"><a href="{{ route('posts.index') }}">Contactリスト</a></div>
<div class="row article-post">
  <div class="col-8 offset-2">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">名前</th>
            <th scope="col">状態</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr>
            <th scope="row">{{ $contact->id }}</th>
            <td><a href="{{ route('contact.edit', ['contact' => $contact]) }}" style="color: white">{{ $contact->your_name }}</a></td>
            <td>
              <span class="{{ $contact->status_class }}">{{ $contact->status_label }}</span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
