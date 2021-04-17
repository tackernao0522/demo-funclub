<!-- Dropdown -->
@if (Auth::user()->role === 'admin')
<div class="ml-auto card-text">
  <div class="dropdown" style="margin: 0 0 5px 85%">
    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <button type="button" class="btn btn-primary text-muted m-0 p-2">
        <i class="fas fa-caret-down" style="color: white; width: 20px"></i>
      </button>
    </a>
    <div class="dropdown-menu dropdown-menu-left" style="margin-top: 25px; margin-right: 135px">
      <a class="dropdown-item" href="{{ route('articles.edit', ['post' => $post]) }}">
        <i class="fas fa-pen mr-1"></i>編集する
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-danger" data-toggle="modal" data-target="#">
        <i class="fas fa-trash-alt mr-1"></i>投稿を削除する
      </a>
    </div>
  </div>
</div>
<!-- Dropdown -->

<!-- modal -->
<div id="" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          {{-- $postApp->title --}}を削除します。よろしいですか？
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
          <button type="submit" class="btn btn-danger">削除する</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
