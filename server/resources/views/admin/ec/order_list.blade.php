@extends('layouts.app')

@section('title')
オーダーリスト
@endsection

@section('content')
{{Form::hidden('', $increment = 1)}}
@include('share.status_card')
<div class="container">
    <div class="header-title"><a href="{{ route('admin') }}">オーダーリスト</a></div>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline" mthod="GET" action="{{ route('item.orders') }}">
            <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="状態:1or2又は名前" value="{{ $defaults['keyword'] ?? '' }}" style="border:1px solid; width: 155px">
            <button class="btn btn-outline-success my-2 my-sm-0 contact-search" type="submit" style="height: 35px; line-height: 10px; width: 50px; font-size: 11px">検索</button>
        </form>
    </nav>
    <div class="row">
        <div class="col-sm">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%"></th>
                        <th scope="col" style="width: 30%">状態</th>
                        <th scope="col" style="width: 30%">名前</th>
                        <th scope="col" style="width: 30%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $increment }}</td>
                        @if ($order->status == 1)
                        <td scope="row"><span class="{{ $order->status_class }}">1:{{ $order->status_label }}</span></td>
                        @else
                        <td scope="row"><span class="{{ $order->status_class }}">2:{{ $order->status_label }}</span></td>
                        @endif
                        <td><a href="{{ route('order.edit', ['id' => $order]) }}" style="color: white">{{ $order->name }}</a></td>
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
                                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $order->id }}">
                                            <i class="fas fa-trash-alt pl-1"></i>このリストを削除する
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Dropdown -->

                            <!-- modal -->
                            <div id="modal-delete-{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('order.destroy', ['id' => $order->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body" style="color: black">
                                                リスト：{{ $order->name }}さんを削除します。よろしいですか？
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
                    {{Form::hidden('', $increment = $increment + 1)}}
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3 pt-1">
                <div style="margin-top: -6px">
                    <button class="btn btn-primary" type="button" onclick="history.back()">Back</button>
                </div>
                {{ $orders->appends(Request::only('keyword'))->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
