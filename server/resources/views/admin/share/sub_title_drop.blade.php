<!-- Dropdown -->
@if ( Auth::check() && Auth::user()->role === 'admin' )
<div class="ml-auto card-text text-center">
  <div class="dropdown pb-3">
    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <button type="button" class="btn btn-primary text-muted m-0 p-2" style="width: 200px">
        <i class="fas fa-caret-down" style="color: white"></i>
      </button>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="margin-top: 25px; width: 200px">
      <a class="dropdown-item" href="{{ route('subTitle.edit') }}">
        <i class="fas fa-pen mr-1"></i>編集する
      </a>
    </div>
  </div>
</div>
<!-- Dropdown -->
@endif
