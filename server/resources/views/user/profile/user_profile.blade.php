@extends('shop.shop_master')

@section('title')
ユーザープロフィール更新
@endsection

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">

            @include('user.common.user_sidebar')

            <div class="col-md-2">

            </div> <!-- end col-md-2 -->

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><strong>{{ Auth::user()->name }}さん</strong>のプロフィール更新</h3>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">ユーザー名(必須) <span> </span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">メールアドレス(必須) <span> </span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">電話番号(任意) <span> </span></label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">プロフィール画像 <span> </span></label>
                                <input type="file" name="profile_photo_path" class="form-control">
                                @error('profile_photo_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">更新</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col-md-6 -->
        </div> <!-- end row -->
    </div>
</div>
@endsection