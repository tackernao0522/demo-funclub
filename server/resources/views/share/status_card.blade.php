<div class="col-8 offset-2 text-center" id="status-alert" style="padding-top: 30px">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
</div>