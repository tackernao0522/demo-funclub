@extends('layouts.app')

@section('title')
Top
@endsection

@section('content')
<div id="home" class="big-bg">
  @include('share.home_header')
  <div class="row article-post">
    <div class="col-8 offset-2">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </div>
  <div class="home-content wrapper">
    <!-- Dropdown -->
    @if ( Auth::check() && Auth::user()->role === 'admin' )
    <div class="ml-auto card-text text-center">
      <div class="dropdown mt-2 pb-3">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-light text-muted m-0 p-2" style="width: 200px">
            <i class="fas fa-caret-down" style="color: blue"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="margin-top: 25px; width: 200px; text-align:center">
          <a class="dropdown-item" href="{{ route('top.edit_form')}}">
            <i class="fas fa-pen mr-1"></i>編集する
          </a>
        </div>
      </div>
    </div>
    <!-- Dropdown -->
    @endif
    <h2 class="page-title">{{ $top->main_title }}</h2>
    <p>{!! nl2br(e( $top->content )) !!}</p>
    @if ( Auth::check() && Auth::user()->role === 'admin')
    <div style="margin-bottom: 70px">
      <a class="button" href="{{ route('informations.index') }}">INFORMATION</a>
    </div>
    @else
    <a class="button" href="{{ route('informations.index') }}">INFORMATION</a>
    @endif
  </div><!-- /.home-content -->
</div><!-- /#home -->
@endsection
