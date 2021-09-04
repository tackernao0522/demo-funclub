<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">メールマガジン(クーポンゲット!!)</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <p>メルマガ会員登録</p>
        <form action="{{ route('store.newsletter') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">メールアドレス</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="メールアドレス入力">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">申し込む</button>
        </form>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
