@extends('layouts.app')

@section('title')
Contactリスト
@endsection

@section('content')
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
  <div class="header-title"><a href="{{ route('admin') }}">Contactリスト</a></div>
  <nav class="navbar navbar-light bg-light">
    <form class="form-inline" mthod="GET" action="{{ route('contact.list') }}">
      <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="状態:1or2又は名前" value="{{ $defaults['keyword'] ?? '' }}" style="width: 155px">
      <button class="btn btn-outline-success my-2 my-sm-0 contact-search" type="submit" style="height: 35px; line-height: 10px; width: 50px; font-size: 11px">検索</button>
    </form>
  </nav>
  <div class="row">
    <div class="col-sm">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col" style="width: 30%">状態</th>
            <th scope="col" style="width: 30%">名前</th>
            <th scope="col" style="width: 30%"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr>
            @if ($contact->status == 1)
            <th scope="row"><span class="{{ $contact->status_class }}">1:{{ $contact->status_label }}</span></th>
            @else
            <th scope="row"><span class="{{ $contact->status_class }}">2:{{ $contact->status_label }}</span></th>
            @endif
            <td><a href="{{ route('contact.edit', ['contact' => $contact]) }}" style="color: white">{{ $contact->your_name }}</a></td>
            <td>
              <!-- Dropdown -->
              <div class="card-text">
                <div class="dropdown pb-1" style="height: 10px">
                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="text-muted" style="height: 30px;">
                      <i class="fas fa-caret-square-down"></i>
                    </button>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" style="margin: 25px 0 0 50px; width: 200px">
                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $contact->id }}">
                      <i class="fas fa-trash-alt pl-1"></i>このリストを削除する
                    </a>
                  </div>
                </div>
              </div>
              <!-- Dropdown -->

              <!-- modal -->
              <div id="modal-delete-{{ $contact->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{ route('contacts.destroy', ['id' => $contact->id]) }}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body" style="color: black">
                        リスト：{{ $contact->your_name }}さんを削除します。よろしいですか？
                      </div>
                      <div class="modal-footer justify-content-between">
                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                        <button type="submit" class="btn btn-danger">削除する</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="justify-content-center mt-3">
        {{ $contacts->appends(Request::only('keyword'))->links() }}
      </div>
      <button class="btn btn-primary" type="button" onclick="history.back()">Back</button>
    </div>
  </div>
</div>
@endsection
