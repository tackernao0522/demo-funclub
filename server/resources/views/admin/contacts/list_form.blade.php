@extends('layouts.article')

@section('title')
Contactチェック
@endsection

@section('content')
<div class="header-title post"><a href="{{ route('contact.list') }}">Contactチェック</a></div>
<div class="container">
  <div class="row">
    <div class="input-form">
      <nav class="panel panel-default">
        <div class="panel-heading">Contactチェック</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('contact.edit', ['contact' => $contact->id]) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="article" for="your_name">お名前</label>
              <div style="font-size: 1.5rem">
                {{ $contact->your_name }}
              </div>
              <input type="hidden" class="form-control" name="your_name" id="your_name" value="{{ $contact->your_name }}" />
            </div>
            <div class="form-group">
              <label class="article" for="your_email">メールアドレス</label>
              <div style="font-size: 1.5rem">
                {{ $contact->your_email }}
              </div>
              <input type="hidden" class="form-control" name="your_email" id="your_email" value="{{ $contact->your_email }}" />
            </div>
            <div class="form-group">
              <label class="article" for="your_message">メッセージ</label>
              <div style="font-size: 1.5rem !important">
                {!! nl2br(e( $contact['your_message'] )) !!}
              </div>
              <input type="hidden" name="your_message" value="{{ $contact->your_message }}">
            </div>
            <div class="form-group">
              <label class="article" for="status">状態</label>
              <select name="status" class="form-control">
                @foreach(\App\Contact::STATUS as $key => $val)
                <option value="{{ $key }}" {{ $key == old('status', $contact->status) ? 'selected' : '' }}>
                  {{ $val['label'] }}
                </option>
                @endforeach
              </select>
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
