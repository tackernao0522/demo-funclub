@php
$id = Auth::user()->id;
$adminData = App\User::find($id);
@endphp
<div class="col-md-2"><br>
    @if ( Auth::user()->role === 'admin' )
    <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($adminData->profile_photo_path)) ? Storage::disk('s3')->url("admin-profile/{$adminData->profile_photo_path}") : url('upload/no_image.jpg') }}" alt="プロフィール画像" height="100%" width="100%"><br><br>
    @else
    <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path)) ? Storage::disk('s3')->url("user-profile/{$user->profile_photo_path}") : url('upload/no_image.jpg') }}" alt="プロフィール画像" height="100%" width="100%"><br><br>
    @endif
    <ul class="list-group list-group-flush">
        <a href="{{ route('shop.index') }}" class="btn btn-primary btn-sm btn-block">ショップホーム</a>
        @if ( Auth::user()->role === 'admin' )
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-sm btn-block">プロフィール更新</a>
        <a href="{{ route('admin.change.password') }}" class="btn btn-primary btn-sm btn-block">パスワード変更</a>
        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">購入リスト</a>
        <a href="{{-- route('return.order.list') --}}" class="btn btn-primary btn-sm btn-block">返品依頼リスト</a>
        <a href="{{-- route('cancel.orders') --}}" class="btn btn-primary btn-sm btn-block">キャンセル商品リスト</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">プロフィール更新</a>
        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">パスワード変更</a>
        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">購入リスト</a>
        <a href="{{-- route('return.order.list') --}}" class="btn btn-primary btn-sm btn-block">返品依頼リスト</a>
        <a href="{{-- route('cancel.orders') --}}" class="btn btn-primary btn-sm btn-block">キャンセル商品リスト</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif
    </ul>
</div> <!-- end col-md-2 -->
