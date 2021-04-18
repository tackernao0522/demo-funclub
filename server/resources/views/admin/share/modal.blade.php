<!-- Dropdown -->
@if (Auth::user()->role === 'admin')
<div class="ml-auto card-text text-center">
  <div class="dropdown pb-1">
    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <button type="button" class="btn btn-primary text-muted m-0 p-2" style="width: 200px">
        <i class="fas fa-caret-down" style="color: white"></i>
      </button>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="margin-top: 25px; width: 200px">
      <a class="dropdown-item" href="{{ route('articles.edit', ['post' => $post]) }}">
        <i class="fas fa-pen mr-1"></i>編集する
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
        <i class="fas fa-trash-alt mr-1"></i>投稿を削除する
      </a>
    </div>
  </div>
</div>
<!-- Dropdown -->

<!-- modal -->
<div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('articles.destroy', ['id' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          {{ $post->post_title }}を削除します。よろしいですか？
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
