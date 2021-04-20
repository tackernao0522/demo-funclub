<!-- Dropdown -->
<div class="card-text" style="margin-left: 238px; margin-top: -29px;">
  <div class="dropdown pb-1" style="height: 10px">
    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <button type="button" class="text-muted" style="height: 30px;">
      <i class="fas fa-caret-square-down"></i>
      </button>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="margin-top: 25px; width: 200px">
      <a class="dropdown-item" href="{{ route('small_image.edit', [$info->id]) }}">
        <i class="fas fa-pen mr-1"></i>編集する
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $info->id }}">
        <i class="fas fa-trash-alt mr-1"></i>投稿を削除する
      </a>
    </div>
  </div>
</div>
<!-- Dropdown -->

<!-- modal -->
<div id="modal-delete-{{ $info->id }}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('info.destroy', ['id' => $info->id]) }}">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          Info画像ID：{{ $info->id }}を削除します。よろしいですか？
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
          <button type="submit" class="btn btn-danger">削除する</button>
        </div>
      </form>
    </div>
  </div>
</div>
